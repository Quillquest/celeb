Flysystem v1 → v3 migration guide (safe snippets)

Purpose
- Show small, safe code snippets to migrate SFTP adapter registration and common `Storage` usages when upgrading to Flysystem v3 + Laravel 9/10.
- This file is informational and non-destructive. Apply edits in a feature branch and run composer dry-runs before changing production code.

Checklist
- [ ] Create a feature branch and commit current `composer.json` + `composer.lock`.
- [ ] Run `composer outdated` and `composer audit`.
- [ ] Replace v1-only adapters in `composer.json` (dry-run first).
- [ ] Update `AppServiceProvider` adapter registration as shown below (in a feature branch).
- [ ] Update direct adapter instantiations in code (search for `new SftpAdapter`, `getDriver()` usages).
- [ ] Run test suite and manual smoke tests (file uploads/downloads, SFTP/S3 flows).

Files to inspect (from repository scan)
- `app/Providers/AppServiceProvider.php` — registers SFTP in Storage::extend
- `app/Http/Controllers/Admin/KycController.php` — Storage::disk('public')->exists/delete
- `app/Http/Controllers/Admin/FrontendController.php` — Storage::disk('public')->exists/delete
- `app/Http/Controllers/Admin/ManageDepositController.php` — Storage::disk('public')->delete
- `app/Http/Controllers/Admin/MembershipController.php` — Storage::disk('public')->exists/delete
- `app/Http/Controllers/Admin/Settings/AppSettingsController.php` — Storage::disk('public')->delete
- `app/Http/Controllers/Admin/Settings/PaymentController.php` — Storage::disk('public')->exists/delete

A. AppServiceProvider: dual-support registration (pattern)

- Goal: register an `sftp` driver that works while Flysystem v1 is installed and that is easy to swap for v3 when you upgrade.
- Approach: detect adapter class availability, prefer v3 if present, fall back to v1. Keep this code in a feature branch and test.

Example (conceptual - adapt namespaces to installed packages):

```php
// ...existing code imports...
use Illuminate\Support\Facades\Storage as FacadesStorage;
use League\Flysystem\Filesystem;
// v1 SFTP adapter (current)
use League\Flysystem\Sftp\SftpAdapter as SftpAdapterV1;
// v3 SFTP adapter (example namespace; confirm on your environment)
use League\Flysystem\SftpV3\SftpAdapter as SftpAdapterV3;

// inside boot():
FacadesStorage::extend('sftp', function ($app, $config) {
    // Prefer v3 adapter if available
    if (class_exists(\League\\Flysystem\\SftpV3\\SftpAdapter::class)) {
        // Example for v3 - actual constructor/adapter factory may differ; consult adapter docs
        $adapter = new SftpAdapterV3($config);
        return new \League\Flysystem\Filesystem($adapter);
    }

    // Fallback to v1 (existing behavior)
    if (class_exists(\League\\Flysystem\\Sftp\\SftpAdapter::class)) {
        return new Filesystem(new SftpAdapterV1($config));
    }

    throw new \RuntimeException('No supported SFTP adapter is installed.');
});
```

Notes:
- Confirm the actual adapter class and constructor signature after installing `league/flysystem-sftp-v3`.
- The snippet above is intentionally conservative: it checks class availability and throws a clear error if none are installed.

B. Common `Storage` usage mapping (no-op in most cases)

Most `Storage::disk('name')->exists|get|put|delete|allFiles` calls continue to work unchanged across Flysystem v1→v3. Example conversions:

Existing (v1) patterns — keep these where possible:
```php
if (Storage::disk('public')->exists($path)) {
    Storage::disk('public')->delete($path);
}
$content = Storage::disk('public')->get($path);
Storage::disk('public')->put($path, $contents);
$files = Storage::disk('public')->allFiles('photos');
```

Edge cases to update
- Direct adapter use: code that calls `->getDriver()` or instantiates `new Filesystem(new SftpAdapter(...))` must be migrated to the v3 adapter API.
- If you relied on adapter-specific features (visibility converters, custom stream filters), consult the v3 adapter docs for equivalents.

Example replacement for direct adapter instantiation (conceptual):

```php
// v1 (existing)
$filesystem = new \League\Flysystem\Filesystem(new \League\Flysystem\Sftp\SftpAdapter($config));
// v3 (conceptual - check adapter docs for exact usage)
$adapter = new \League\Flysystem\SftpV3\SftpAdapter($config);
$filesystem = new \League\Flysystem\Filesystem($adapter);
```

C. Testing checklist
- Run composer dry-run for adapter replacements:

```
composer remove league/flysystem-sftp league/flysystem-aws-s3-v3 --dry-run -W
composer require league/flysystem:^3.8 league/flysystem-sftp-v3 --dry-run -W
composer require "laravel/framework:^9.36" --dry-run -W
```

- Create feature branch and apply changes only after dry-run output looks acceptable.
- Run `php artisan optimize:clear`, `php artisan migrate --pretend` (if migrations exist), and `vendor/bin/phpunit` (if you have tests).

D. Quick code snippets for migration examples
- Replace direct `getDriver()` usage (example):

```php
// v1
$driver = Storage::disk('public')->getDriver();
// avoid relying on driver internals; use Storage facade methods where possible:
$files = Storage::disk('public')->allFiles();
```

- When you need adapter-level operations (SFTP-specific), encapsulate them behind a service so only the service must change between v1/v3 adapters.

E. Rollback strategy
- Keep feature branch and commit `composer.lock` changes.
- If any step fails, revert composer changes:
```
git checkout -- composer.json composer.lock
composer install
```

F. Contacts and references
- Flysystem v3 docs: https://flysystem.thephpleague.com/v3/
- league/flysystem-sftp-v3 repository: (look up latest docs after adding package)
- Laravel filesystem docs: https://laravel.com/docs/filesystem


==== End of migration guidance ====
