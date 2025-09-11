
<?php $__env->startSection('title', 'Join Our Celebrity Network'); ?>
<?php $__env->startSection('content'); ?>

    <div class="min-h-screen bg-gradient-to-br from-slate-50 to-blue-50 dark:from-gray-900 dark:to-slate-900 py-8 px-4"
        x-data="{
            currentStep: 1,
            totalSteps: 3,
            formData: {
                username: '',
                name: '',
                email: '',
                phone: '',
                country: '',
                password: '',
                password_confirmation: '',
                interests: [],
                vip_access: false,
                marketing_consent: false
            },
            showPassword: false,
            showConfirmPassword: false,
            isSubmitting: false,
            nextStep() {
                if (this.currentStep < this.totalSteps) {
                    this.currentStep++
                }
            },
            prevStep() {
                if (this.currentStep > 1) {
                    this.currentStep--
                }
            },
            toggleInterest(interest) {
                const index = this.formData.interests.indexOf(interest)
                if (index > -1) {
                    this.formData.interests.splice(index, 1)
                } else {
                    this.formData.interests.push(interest)
                }
            }
        }" x-init="console.log('Celebrity Registration initialized')">

        <!-- Header Section -->
        <div class="max-w-2xl mx-auto text-center mb-8">
            <div class="mb-6">
                <img src="<?php echo e(asset('storage/' . $settings->logo)); ?>" alt="<?php echo e($settings->site_name); ?>"
                    class="h-16 w-16 mx-auto rounded-full shadow-lg">
            </div>

            <h1 class="text-3xl md:text-4xl font-bold text-gray-900 dark:text-white mb-3">
                Join Our Celebrity Network
            </h1>
            <p class="text-gray-600 dark:text-gray-300 text-lg max-w-lg mx-auto">
                Connect with your favorite celebrities and unlock exclusive experiences
            </p>
        </div>

        <!-- Progress Steps -->
        <div class="max-w-2xl mx-auto mb-12">
            <div class="flex items-center justify-center">
                <template x-for="step in totalSteps" :key="step">
                    <div class="flex items-center">
                        <!-- Step Circle -->
                        <div class="relative">
                            <div class="w-12 h-12 rounded-full flex items-center justify-center font-semibold transition-all duration-300"
                                :class="step <= currentStep ? 'bg-blue-600 text-white shadow-lg' :
                                    'bg-gray-200 dark:bg-gray-700 text-gray-500 dark:text-gray-400'">
                                <i x-show="step < currentStep" data-lucide="check" class="w-5 h-5"></i>
                                <span x-show="step >= currentStep" x-text="step"></span>
                            </div>
                            <!-- Step Label -->
                            <div
                                class="absolute top-14 left-1/2 transform -translate-x-1/2 text-xs text-gray-600 dark:text-gray-400 whitespace-nowrap font-medium">
                                <span x-show="step === 1">Personal Info</span>
                                <span x-show="step === 2">Security</span>
                                <span x-show="step === 3">Preferences</span>
                            </div>
                        </div>
                        <!-- Connector Line -->
                        <div x-show="step < totalSteps" class="w-16 h-1 mx-4 rounded-full transition-colors duration-300"
                            :class="step < currentStep ? 'bg-blue-600' : 'bg-gray-200 dark:bg-gray-700'"></div>
                    </div>
                </template>
            </div>
        </div>

        <!-- Main Registration Form -->
        <div class="max-w-2xl mx-auto">
            <div
                class="bg-white dark:bg-gray-800 rounded-2xl shadow-xl border border-gray-100 dark:border-gray-700 overflow-hidden">

                <!-- Status Messages -->
                <?php if(session('status')): ?>
                    <div class="bg-blue-50 dark:bg-blue-900/20 border-l-4 border-blue-400 p-4 m-6 rounded-r-lg">
                        <div class="flex items-center">
                            <i data-lucide="info" class="h-5 w-5 text-blue-600 dark:text-blue-400 mr-3"></i>
                            <p class="text-blue-800 dark:text-blue-200 text-sm"><?php echo e(session('status')); ?></p>
                        </div>
                    </div>
                <?php endif; ?>

                <?php if($errors->any()): ?>
                    <div class="bg-red-50 dark:bg-red-900/20 border-l-4 border-red-400 p-4 m-6 rounded-r-lg">
                        <div class="flex items-start">
                            <i data-lucide="alert-circle" class="h-5 w-5 text-red-600 dark:text-red-400 mr-3 mt-0.5"></i>
                            <div>
                                <h3 class="text-red-800 dark:text-red-200 font-medium text-sm mb-2">Please correct the
                                    following:</h3>
                                <ul class="text-red-700 dark:text-red-300 text-sm space-y-1">
                                    <?php $__currentLoopData = $errors->all(); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $error): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                        <li>• <?php echo e($error); ?></li>
                                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                </ul>
                            </div>
                        </div>
                    </div>
                <?php endif; ?>

                <form action="<?php echo e(route('register')); ?>" method="POST" @submit="isSubmitting = true" class="p-8">
                    <?php echo csrf_field(); ?>

                    <!-- Step 1: Personal Information -->
                    <div x-show="currentStep === 1" x-transition:enter="transition ease-out duration-300"
                        x-transition:enter-start="opacity-0 translate-x-4"
                        x-transition:enter-end="opacity-100 translate-x-0">
                        <h2 class="text-2xl font-bold text-gray-900 dark:text-white mb-6 flex items-center">
                            <i data-lucide="user-circle" class="w-6 h-6 mr-3 text-blue-600"></i>
                            Personal Information
                        </h2>

                        <div class="space-y-6">
                            <!-- Username & Full Name Row -->
                            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                                <div>
                                    <label for="username"
                                        class="block text-sm font-semibold text-gray-700 dark:text-gray-300 mb-2">
                                        Username *
                                    </label>
                                    <div class="relative">
                                        <i data-lucide="at-sign"
                                            class="absolute left-3 top-1/2 transform -translate-y-1/2 w-5 h-5 text-gray-400"></i>
                                        <input type="text" id="username" name="username" value="<?php echo e(old('username')); ?>"
                                            x-model="formData.username" required
                                            class="w-full pl-12 pr-4 py-3 bg-gray-50 dark:bg-gray-700 border border-gray-200 dark:border-gray-600 rounded-xl text-gray-900 dark:text-white placeholder-gray-500 focus:ring-2 focus:ring-blue-500 focus:border-transparent transition-all duration-200"
                                            placeholder="Your unique username">
                                    </div>
                                    <?php $__errorArgs = ['username'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                                        <p class="text-red-500 text-xs mt-1"><?php echo e($message); ?></p>
                                    <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                                </div>

                                <div>
                                    <label for="name"
                                        class="block text-sm font-semibold text-gray-700 dark:text-gray-300 mb-2">
                                        Full Name *
                                    </label>
                                    <div class="relative">
                                        <i data-lucide="user"
                                            class="absolute left-3 top-1/2 transform -translate-y-1/2 w-5 h-5 text-gray-400"></i>
                                        <input type="text" id="name" name="name" value="<?php echo e(old('name')); ?>"
                                            x-model="formData.name" required
                                            class="w-full pl-12 pr-4 py-3 bg-gray-50 dark:bg-gray-700 border border-gray-200 dark:border-gray-600 rounded-xl text-gray-900 dark:text-white placeholder-gray-500 focus:ring-2 focus:ring-blue-500 focus:border-transparent transition-all duration-200"
                                            placeholder="Your full name">
                                    </div>
                                    <?php $__errorArgs = ['name'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                                        <p class="text-red-500 text-xs mt-1"><?php echo e($message); ?></p>
                                    <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                                </div>
                            </div>

                            <!-- Email & Phone Row -->
                            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                                <div>
                                    <label for="email"
                                        class="block text-sm font-semibold text-gray-700 dark:text-gray-300 mb-2">
                                        Email Address *
                                    </label>
                                    <div class="relative">
                                        <i data-lucide="mail"
                                            class="absolute left-3 top-1/2 transform -translate-y-1/2 w-5 h-5 text-gray-400"></i>
                                        <input type="email" id="email" name="email" value="<?php echo e(old('email')); ?>"
                                            x-model="formData.email" required
                                            class="w-full pl-12 pr-4 py-3 bg-gray-50 dark:bg-gray-700 border border-gray-200 dark:border-gray-600 rounded-xl text-gray-900 dark:text-white placeholder-gray-500 focus:ring-2 focus:ring-blue-500 focus:border-transparent transition-all duration-200"
                                            placeholder="your@email.com">
                                    </div>
                                    <?php $__errorArgs = ['email'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                                        <p class="text-red-500 text-xs mt-1"><?php echo e($message); ?></p>
                                    <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                                </div>

                                <div>
                                    <label for="phone"
                                        class="block text-sm font-semibold text-gray-700 dark:text-gray-300 mb-2">
                                        Phone Number *
                                    </label>
                                    <div class="relative">
                                        <i data-lucide="phone"
                                            class="absolute left-3 top-1/2 transform -translate-y-1/2 w-5 h-5 text-gray-400"></i>
                                        <input type="tel" id="phone" name="phone" value="<?php echo e(old('phone')); ?>"
                                            x-model="formData.phone" required
                                            class="w-full pl-12 pr-4 py-3 bg-gray-50 dark:bg-gray-700 border border-gray-200 dark:border-gray-600 rounded-xl text-gray-900 dark:text-white placeholder-gray-500 focus:ring-2 focus:ring-blue-500 focus:border-transparent transition-all duration-200"
                                            placeholder="+1 (555) 000-0000">
                                    </div>
                                    <?php $__errorArgs = ['phone'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                                        <p class="text-red-500 text-xs mt-1"><?php echo e($message); ?></p>
                                    <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                                </div>
                            </div>

                            <!-- Country -->
                            <div>
                                <label for="country"
                                    class="block text-sm font-semibold text-gray-700 dark:text-gray-300 mb-2">
                                    Country *
                                </label>
                                <div class="relative">
                                    <i data-lucide="globe"
                                        class="absolute left-3 top-1/2 transform -translate-y-1/2 w-5 h-5 text-gray-400"></i>
                                    <select id="country" name="country" x-model="formData.country" required
                                        class="w-full pl-12 pr-4 py-3 bg-gray-50 dark:bg-gray-700 border border-gray-200 dark:border-gray-600 rounded-xl text-gray-900 dark:text-white focus:ring-2 focus:ring-blue-500 focus:border-transparent transition-all duration-200">
                                        <option value="">Select your country</option>
                                        <?php echo $__env->make('auth.countries', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?>
                                    </select>
                                </div>
                                <?php $__errorArgs = ['country'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                                    <p class="text-red-500 text-xs mt-1"><?php echo e($message); ?></p>
                                <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                            </div>
                        </div>
                    </div>

                    <!-- Step 2: Security -->
                    <div x-show="currentStep === 2" x-transition:enter="transition ease-out duration-300"
                        x-transition:enter-start="opacity-0 translate-x-4"
                        x-transition:enter-end="opacity-100 translate-x-0">
                        <h2 class="text-2xl font-bold text-gray-900 dark:text-white mb-6 flex items-center">
                            <i data-lucide="shield-check" class="w-6 h-6 mr-3 text-blue-600"></i>
                            Account Security
                        </h2>

                        <div class="space-y-6">
                            <!-- Password Fields -->
                            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                                <div>
                                    <label for="password"
                                        class="block text-sm font-semibold text-gray-700 dark:text-gray-300 mb-2">
                                        Password *
                                    </label>
                                    <div class="relative">
                                        <i data-lucide="lock"
                                            class="absolute left-3 top-1/2 transform -translate-y-1/2 w-5 h-5 text-gray-400"></i>
                                        <input :type="showPassword ? 'text' : 'password'" id="password" name="password"
                                            x-model="formData.password" required
                                            class="w-full pl-12 pr-12 py-3 bg-gray-50 dark:bg-gray-700 border border-gray-200 dark:border-gray-600 rounded-xl text-gray-900 dark:text-white placeholder-gray-500 focus:ring-2 focus:ring-blue-500 focus:border-transparent transition-all duration-200"
                                            placeholder="Create strong password">
                                        <button type="button" @click="showPassword = !showPassword"
                                            class="absolute right-3 top-1/2 transform -translate-y-1/2 text-gray-400 hover:text-gray-600 transition-colors">
                                            <i data-lucide="eye" x-show="!showPassword" class="w-5 h-5"></i>
                                            <i data-lucide="eye-off" x-show="showPassword" class="w-5 h-5"></i>
                                        </button>
                                    </div>
                                    <?php $__errorArgs = ['password'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                                        <p class="text-red-500 text-xs mt-1"><?php echo e($message); ?></p>
                                    <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                                </div>

                                <div>
                                    <label for="password_confirmation"
                                        class="block text-sm font-semibold text-gray-700 dark:text-gray-300 mb-2">
                                        Confirm Password *
                                    </label>
                                    <div class="relative">
                                        <i data-lucide="check-circle"
                                            class="absolute left-3 top-1/2 transform -translate-y-1/2 w-5 h-5 text-gray-400"></i>
                                        <input :type="showConfirmPassword ? 'text' : 'password'" id="password_confirmation"
                                            name="password_confirmation" x-model="formData.password_confirmation" required
                                            class="w-full pl-12 pr-12 py-3 bg-gray-50 dark:bg-gray-700 border border-gray-200 dark:border-gray-600 rounded-xl text-gray-900 dark:text-white placeholder-gray-500 focus:ring-2 focus:ring-blue-500 focus:border-transparent transition-all duration-200"
                                            placeholder="Confirm your password">
                                        <button type="button" @click="showConfirmPassword = !showConfirmPassword"
                                            class="absolute right-3 top-1/2 transform -translate-y-1/2 text-gray-400 hover:text-gray-600 transition-colors">
                                            <i data-lucide="eye" x-show="!showConfirmPassword" class="w-5 h-5"></i>
                                            <i data-lucide="eye-off" x-show="showConfirmPassword" class="w-5 h-5"></i>
                                        </button>
                                    </div>
                                </div>
                            </div>

                            <!-- Captcha -->
                            <?php if(isset($settings) && $settings->captcha == 'true'): ?>
                                <div
                                    class="bg-gray-50 dark:bg-gray-700 rounded-xl p-6 border border-gray-200 dark:border-gray-600">
                                    <label class="block text-sm font-semibold text-gray-700 dark:text-gray-300 mb-3">
                                        Security Verification *
                                    </label>
                                    <?php echo NoCaptcha::display(); ?>

                                    <?php $__errorArgs = ['g-recaptcha-response'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                                        <p class="text-red-500 text-xs mt-2"><?php echo e($message); ?></p>
                                    <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                                </div>
                            <?php endif; ?>

                            <!-- Terms & Conditions -->
                            <?php if(isset($terms) && $terms->useterms == 'yes'): ?>
                                <div
                                    class="bg-blue-50 dark:bg-blue-900/20 rounded-xl p-6 border border-blue-200 dark:border-blue-800">
                                    <label class="flex items-start cursor-pointer group">
                                        <input type="checkbox" id="agree" name="agree" required
                                            class="w-5 h-5 text-blue-600 bg-white border-gray-300 rounded focus:ring-blue-500 mt-1 mr-3">
                                        <span class="text-sm text-gray-700 dark:text-gray-300 leading-relaxed">
                                            I agree to the
                                            <a href="<?php echo e(route('privacy')); ?>"
                                                class="text-blue-600 dark:text-blue-400 hover:text-blue-700 font-medium underline">
                                                Terms & Conditions
                                            </a>
                                            and
                                            <a href="#"
                                                class="text-blue-600 dark:text-blue-400 hover:text-blue-700 font-medium underline">
                                                Privacy Policy
                                            </a>
                                        </span>
                                    </label>
                                </div>
                            <?php endif; ?>
                        </div>
                    </div>

                    <!-- Step 3: Preferences -->
                    <div x-show="currentStep === 3" x-transition:enter="transition ease-out duration-300"
                        x-transition:enter-start="opacity-0 translate-x-4"
                        x-transition:enter-end="opacity-100 translate-x-0">
                        <h2 class="text-2xl font-bold text-gray-900 dark:text-white mb-6 flex items-center">
                            <i data-lucide="heart" class="w-6 h-6 mr-3 text-blue-600"></i>
                            Your Interests
                        </h2>

                        <div class="space-y-6">
                            <!-- Celebrity Interests -->
                            <div>
                                <label class="block text-sm font-semibold text-gray-700 dark:text-gray-300 mb-4">
                                    Which celebrities are you interested in? (Select all that apply)
                                </label>
                                <div class="grid grid-cols-2 md:grid-cols-3 gap-3">
                                    <template
                                        x-for="interest in ['Music', 'Movies', 'Sports', 'TV Shows', 'Comedy', 'Fashion', 'Gaming', 'Social Media', 'Books']">
                                        <button type="button" @click="toggleInterest(interest)"
                                            class="p-4 rounded-xl border-2 transition-all duration-200 text-sm font-medium"
                                            :class="formData.interests.includes(interest) ?
                                                'bg-blue-100 border-blue-500 text-blue-700 dark:bg-blue-900/30 dark:border-blue-400 dark:text-blue-300' :
                                                'bg-gray-50 border-gray-200 text-gray-700 hover:bg-gray-100 dark:bg-gray-700 dark:border-gray-600 dark:text-gray-300 dark:hover:bg-gray-600'">
                                            <i data-lucide="star" class="w-4 h-4 mx-auto mb-2"
                                                :class="formData.interests.includes(interest) ? 'text-blue-600' :
                                                    'text-gray-400'"></i>
                                            <div x-text="interest"></div>
                                        </button>
                                    </template>
                                </div>
                                <input type="hidden" name="interests" :value="formData.interests.join(',')">
                            </div>

                            <!-- VIP Access -->
                            <div
                                class="bg-gradient-to-r from-purple-50 to-pink-50 dark:from-purple-900/20 dark:to-pink-900/20 rounded-xl p-6 border border-purple-200 dark:border-purple-800">
                                <label class="flex items-center cursor-pointer">
                                    <input type="checkbox" name="vip_access" x-model="formData.vip_access"
                                        class="w-5 h-5 text-purple-600 bg-white border-gray-300 rounded focus:ring-purple-500 mr-4">
                                    <div>
                                        <div class="font-semibold text-gray-900 dark:text-white">🌟 VIP Access Interest
                                        </div>
                                        <div class="text-sm text-gray-600 dark:text-gray-300">Get notified about exclusive
                                            celebrity events and early access to bookings</div>
                                    </div>
                                </label>
                            </div>

                            <!-- Marketing Consent -->
                            <div
                                class="bg-gray-50 dark:bg-gray-700 rounded-xl p-6 border border-gray-200 dark:border-gray-600">
                                <label class="flex items-center cursor-pointer">
                                    <input type="checkbox" name="marketing_consent" x-model="formData.marketing_consent"
                                        class="w-5 h-5 text-blue-600 bg-white border-gray-300 rounded focus:ring-blue-500 mr-4">
                                    <div>
                                        <div class="font-semibold text-gray-900 dark:text-white">📧 Marketing
                                            Communications</div>
                                        <div class="text-sm text-gray-600 dark:text-gray-300">Receive updates about new
                                            celebrities, special offers, and platform news</div>
                                    </div>
                                </label>
                            </div>
                        </div>
                    </div>

                    <!-- Navigation Buttons -->
                    <div class="flex justify-between items-center pt-8 mt-8 border-t border-gray-200 dark:border-gray-700">
                        <!-- Back Button -->
                        <button type="button" x-show="currentStep > 1" @click="prevStep()"
                            class="flex items-center px-6 py-3 bg-gray-100 dark:bg-gray-700 text-gray-700 dark:text-gray-300 rounded-xl font-medium hover:bg-gray-200 dark:hover:bg-gray-600 transition-all duration-200">
                            <i data-lucide="chevron-left" class="w-4 h-4 mr-2"></i>
                            Back
                        </button>

                        <!-- Next Button -->
                        <button type="button" x-show="currentStep < totalSteps" @click="nextStep()"
                            class="flex items-center px-6 py-3 bg-blue-600 text-white rounded-xl font-medium hover:bg-blue-700 transition-all duration-200 ml-auto">
                            Next Step
                            <i data-lucide="chevron-right" class="w-4 h-4 ml-2"></i>
                        </button>

                        <!-- Submit Button -->
                        <button type="submit" x-show="currentStep === totalSteps" :disabled="isSubmitting"
                            class="flex items-center px-8 py-3 bg-gradient-to-r from-blue-600 to-purple-600 text-white rounded-xl font-medium hover:from-blue-700 hover:to-purple-700 transition-all duration-200 ml-auto disabled:opacity-50 disabled:cursor-not-allowed">
                            <i data-lucide="user-plus" class="w-5 h-5 mr-2" x-show="!isSubmitting"></i>
                            <div x-show="isSubmitting"
                                class="w-5 h-5 border-2 border-white/30 border-t-white rounded-full animate-spin mr-2">
                            </div>
                            <span x-text="isSubmitting ? 'Creating Account...' : 'Create Account'"></span>
                        </button>
                    </div>

                    <!-- Social Login -->
                    <?php if(isset($settings) && $settings->enable_social_login == 'yes'): ?>
                        <div class="mt-8 pt-6 border-t border-gray-200 dark:border-gray-700"
                            x-show="currentStep === totalSteps">
                            <div class="text-center mb-4">
                                <span class="text-gray-500 dark:text-gray-400 text-sm">Or continue with</span>
                            </div>

                            <a href="<?php echo e(route('social.redirect', ['social' => 'google'])); ?>"
                                class="w-full flex items-center justify-center px-4 py-3 bg-white dark:bg-gray-700 border border-gray-300 dark:border-gray-600 rounded-xl text-gray-700 dark:text-gray-300 font-medium hover:bg-gray-50 dark:hover:bg-gray-600 transition-all duration-200">
                                <svg class="w-5 h-5 mr-3" viewBox="0 0 24 24">
                                    <path fill="#4285F4"
                                        d="M22.56 12.25c0-.78-.07-1.53-.2-2.25H12v4.26h5.92c-.26 1.37-1.04 2.53-2.21 3.31v2.77h3.57c2.08-1.92 3.28-4.74 3.28-8.09z" />
                                    <path fill="#34A853"
                                        d="M12 23c2.97 0 5.46-.98 7.28-2.66l-3.57-2.77c-.98.66-2.23 1.06-3.71 1.06-2.86 0-5.29-1.93-6.16-4.53H2.18v2.84C3.99 20.53 7.7 23 12 23z" />
                                    <path fill="#FBBC05"
                                        d="M5.84 14.09c-.22-.66-.35-1.36-.35-2.09s.13-1.43.35-2.09V7.07H2.18C1.43 8.55 1 10.22 1 12s.43 3.45 1.18 4.93l2.85-2.22.81-.62z" />
                                    <path fill="#EA4335"
                                        d="M12 5.38c1.62 0 3.06.56 4.21 1.64l3.15-3.15C17.45 2.09 14.97 1 12 1 7.7 1 3.99 3.47 2.18 7.07l3.66 2.84c.87-2.6 3.3-4.53 6.16-4.53z" />
                                </svg>
                                Continue with Google
                            </a>
                        </div>
                    <?php endif; ?>
                </form>
            </div>

            <!-- Login Link -->
            <div class="text-center mt-8">
                <p class="text-gray-600 dark:text-gray-300">
                    Already have an account?
                    <a href="<?php echo e(route('login')); ?>"
                        class="text-blue-600 dark:text-blue-400 hover:text-blue-700 font-medium">
                        Sign in here
                    </a>
                </p>
            </div>
        </div>
    </div>

<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.base1', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH /Users/user/Desktop/Websites/Broker/Celebrity/Celebrity/resources/views/auth/modern_register.blade.php ENDPATH**/ ?>