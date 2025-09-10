<?php $__env->startSection('title', $title); ?>
<?php $__env->startSection('content'); ?>

<!-- Hero Section -->
<section class="pt-32 pb-16 bg-gradient-to-br from-gray-900 via-primary-900 to-gray-900 relative overflow-hidden">
    <!-- Background Elements -->
    <div class="absolute inset-0 overflow-hidden">
        <!-- Animated gradient circles -->
        <div class="absolute -top-20 -right-20 w-96 h-96 bg-primary-400 rounded-full mix-blend-overlay filter blur-3xl opacity-20 animate-float"></div>
        <div class="absolute -bottom-20 -left-20 w-96 h-96 bg-accent-500 rounded-full mix-blend-overlay filter blur-3xl opacity-20 animate-float animation-delay-2000"></div>

        <!-- Subtle grid pattern -->
        <div class="absolute inset-0 bg-grid-white/[0.03] bg-[length:30px_30px]" aria-hidden="true"></div>
    </div>

    <div class="container mx-auto px-4 sm:px-6 lg:px-8 relative z-10">
        <div class="text-center max-w-3xl mx-auto">
            <span class="inline-block px-4 py-2 bg-white/10 backdrop-blur-sm border border-white/20 rounded-full text-white text-sm font-semibold mb-4">
                <i data-lucide="message-circle" class="w-4 h-4 inline mr-2"></i>
                Get In Touch
            </span>
            <h1 class="text-3xl sm:text-4xl lg:text-5xl font-display font-bold text-white mb-6 leading-tight">
                Contact <span class="text-primary-400">Our Team</span>
            </h1>
            <p class="text-lg text-white/80 mb-8">
                Have questions about booking celebrities or need assistance? We're here to help make your celebrity experience unforgettable.
            </p>
        </div>
    </div>
</section>

<!-- Contact Section -->
<section class="py-12 lg:py-20 bg-gray-50">
    <div class="container mx-auto px-4 sm:px-6 lg:px-8">
        <div class="grid grid-cols-1 lg:grid-cols-3 gap-12">
            <!-- Contact Information -->
            <div class="lg:col-span-1">
                <div class="bg-white rounded-2xl p-8 shadow-xl border border-gray-100 h-fit">
                    <h2 class="text-2xl font-display font-bold text-gray-900 mb-6">
                        <i data-lucide="phone" class="w-6 h-6 text-primary-600 inline mr-2"></i>
                        Contact Information
                    </h2>

                    <!-- Contact Items -->
                    <div class="space-y-6">
                        <!-- Email -->
                        <div class="flex items-start">
                            <div class="flex-shrink-0">
                                <div class="w-12 h-12 bg-primary-100 rounded-lg flex items-center justify-center">
                                    <i data-lucide="mail" class="w-6 h-6 text-primary-600"></i>
                                </div>
                            </div>
                            <div class="ml-4">
                                <h3 class="text-lg font-semibold text-gray-900 mb-1">Email Us</h3>
                                <p class="text-gray-600"><?php echo e($settings->contact_email ?? 'support@celebritybooking.com'); ?></p>
                                <p class="text-sm text-gray-500 mt-1">We'll respond within 24 hours</p>
                            </div>
                        </div>

                        <!-- Phone -->
                        <div class="flex items-start">
                            <div class="flex-shrink-0">
                                <div class="w-12 h-12 bg-accent-100 rounded-lg flex items-center justify-center">
                                    <i data-lucide="phone" class="w-6 h-6 text-accent-600"></i>
                                </div>
                            </div>
                            <div class="ml-4">
                                <h3 class="text-lg font-semibold text-gray-900 mb-1">Call Us</h3>
                                <p class="text-gray-600"><?php echo e($settings->whatsapp ?? '+1 (555) 123-4567'); ?></p>
                                <p class="text-sm text-gray-500 mt-1">Mon-Fri, 9am-6pm EST</p>
                            </div>
                        </div>

                        <!-- Address -->
                        <div class="flex items-start">
                            <div class="flex-shrink-0">
                                <div class="w-12 h-12 bg-primary-100 rounded-lg flex items-center justify-center">
                                    <i data-lucide="map-pin" class="w-6 h-6 text-primary-600"></i>
                                </div>
                            </div>
                            <div class="ml-4">
                                <h3 class="text-lg font-semibold text-gray-900 mb-1">Visit Us</h3>
                                <p class="text-gray-600"><?php echo e($settings->locations ?? 'Los Angeles, CA 90210'); ?></p>
                                <p class="text-sm text-gray-500 mt-1">By appointment only</p>
                            </div>
                        </div>
                    </div>

                    <!-- Social Links -->
                    <div class="mt-8 pt-6 border-t border-gray-200">
                        <h3 class="text-lg font-semibold text-gray-900 mb-4">Follow Us</h3>
                        <div class="flex space-x-3">
                            <a href="#" class="w-10 h-10 bg-blue-100 rounded-lg flex items-center justify-center text-blue-600 hover:bg-blue-200 transition-colors duration-300">
                                <i data-lucide="facebook" class="w-5 h-5"></i>
                            </a>
                            <a href="#" class="w-10 h-10 bg-sky-100 rounded-lg flex items-center justify-center text-sky-600 hover:bg-sky-200 transition-colors duration-300">
                                <i data-lucide="twitter" class="w-5 h-5"></i>
                            </a>
                            <a href="#" class="w-10 h-10 bg-pink-100 rounded-lg flex items-center justify-center text-pink-600 hover:bg-pink-200 transition-colors duration-300">
                                <i data-lucide="instagram" class="w-5 h-5"></i>
                            </a>
                            <a href="#" class="w-10 h-10 bg-blue-100 rounded-lg flex items-center justify-center text-blue-700 hover:bg-blue-200 transition-colors duration-300">
                                <i data-lucide="linkedin" class="w-5 h-5"></i>
                            </a>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Contact Form -->
            <div class="lg:col-span-2">
                <div class="bg-white rounded-2xl p-8 shadow-xl border border-gray-100">
                    <h2 class="text-2xl font-display font-bold text-gray-900 mb-6">
                        <i data-lucide="send" class="w-6 h-6 text-primary-600 inline mr-2"></i>
                        Send Us a Message
                    </h2>

                    <!-- Success/Error Messages -->
                    <?php if(session('success')): ?>
                        <div class="mb-6 p-4 bg-green-50 border border-green-200 rounded-lg">
                            <div class="flex items-center">
                                <i data-lucide="check-circle" class="w-5 h-5 text-green-600 mr-2"></i>
                                <p class="text-green-800"><?php echo e(session('success')); ?></p>
                            </div>
                        </div>
                    <?php endif; ?>

                    <?php if(session('error')): ?>
                        <div class="mb-6 p-4 bg-red-50 border border-red-200 rounded-lg">
                            <div class="flex items-center">
                                <i data-lucide="alert-circle" class="w-5 h-5 text-red-600 mr-2"></i>
                                <p class="text-red-800"><?php echo e(session('error')); ?></p>
                            </div>
                        </div>
                    <?php endif; ?>

                    <!-- Contact Form -->
                    <form action="<?php echo e(route('contact.send')); ?>" method="POST" class="space-y-6" x-data="contactForm()">
                        <?php echo csrf_field(); ?>

                        <!-- Name and Email Row -->
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                            <!-- Name -->
                            <div>
                                <label for="name" class="block text-sm font-semibold text-gray-700 mb-2">
                                    Full Name <span class="text-red-500">*</span>
                                </label>
                                <div class="relative">
                                    <i data-lucide="user" class="absolute top-3 left-3 w-5 h-5 text-gray-400"></i>
                                    <input
                                        type="text"
                                        id="name"
                                        name="name"
                                        value="<?php echo e(old('name', auth()->user()->name ?? '')); ?>"
                                        required
                                        class="w-full pl-10 pr-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-primary-500 focus:border-transparent transition-all duration-300 <?php $__errorArgs = ['name'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> border-red-500 <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>"
                                        placeholder="Enter your full name"
                                    >
                                    <?php $__errorArgs = ['name'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                                        <p class="mt-1 text-sm text-red-600"><?php echo e($message); ?></p>
                                    <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                                </div>
                            </div>

                            <!-- Email -->
                            <div>
                                <label for="email" class="block text-sm font-semibold text-gray-700 mb-2">
                                    Email Address <span class="text-red-500">*</span>
                                </label>
                                <div class="relative">
                                    <i data-lucide="mail" class="absolute top-3 left-3 w-5 h-5 text-gray-400"></i>
                                    <input
                                        type="email"
                                        id="email"
                                        name="email"
                                        value="<?php echo e(old('email', auth()->user()->email ?? '')); ?>"
                                        required
                                        class="w-full pl-10 pr-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-primary-500 focus:border-transparent transition-all duration-300 <?php $__errorArgs = ['email'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> border-red-500 <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>"
                                        placeholder="Enter your email address"
                                    >
                                    <?php $__errorArgs = ['email'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                                        <p class="mt-1 text-sm text-red-600"><?php echo e($message); ?></p>
                                    <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                                </div>
                            </div>
                        </div>

                        <!-- Phone and Subject Row -->
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                            <!-- Phone -->
                            <div>
                                <label for="phone" class="block text-sm font-semibold text-gray-700 mb-2">
                                    Phone Number
                                </label>
                                <div class="relative">
                                    <i data-lucide="phone" class="absolute top-3 left-3 w-5 h-5 text-gray-400"></i>
                                    <input
                                        type="tel"
                                        id="phone"
                                        name="phone"
                                        value="<?php echo e(old('phone', auth()->user()->phone ?? '')); ?>"
                                        class="w-full pl-10 pr-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-primary-500 focus:border-transparent transition-all duration-300 <?php $__errorArgs = ['phone'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> border-red-500 <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>"
                                        placeholder="Enter your phone number"
                                    >
                                    <?php $__errorArgs = ['phone'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                                        <p class="mt-1 text-sm text-red-600"><?php echo e($message); ?></p>
                                    <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                                </div>
                            </div>

                            <!-- Subject -->
                            <div>
                                <label for="subject" class="block text-sm font-semibold text-gray-700 mb-2">
                                    Subject <span class="text-red-500">*</span>
                                </label>
                                <div class="relative">
                                    <i data-lucide="tag" class="absolute top-3 left-3 w-5 h-5 text-gray-400"></i>
                                    <select
                                        id="subject"
                                        name="subject"
                                        required
                                        class="w-full pl-10 pr-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-primary-500 focus:border-transparent transition-all duration-300 <?php $__errorArgs = ['subject'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> border-red-500 <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>"
                                    >
                                        <option value="">Select a subject</option>
                                        <option value="General Inquiry" <?php echo e(old('subject') == 'General Inquiry' ? 'selected' : ''); ?>>General Inquiry</option>
                                        <option value="Celebrity Booking" <?php echo e(old('subject') == 'Celebrity Booking' ? 'selected' : ''); ?>>Celebrity Booking</option>
                                        <option value="Event Planning" <?php echo e(old('subject') == 'Event Planning' ? 'selected' : ''); ?>>Event Planning</option>
                                        <option value="Pricing Information" <?php echo e(old('subject') == 'Pricing Information' ? 'selected' : ''); ?>>Pricing Information</option>
                                        <option value="Technical Support" <?php echo e(old('subject') == 'Technical Support' ? 'selected' : ''); ?>>Technical Support</option>
                                        <option value="Partnership" <?php echo e(old('subject') == 'Partnership' ? 'selected' : ''); ?>>Partnership</option>
                                        <option value="Complaint" <?php echo e(old('subject') == 'Complaint' ? 'selected' : ''); ?>>Complaint</option>
                                        <option value="Other" <?php echo e(old('subject') == 'Other' ? 'selected' : ''); ?>>Other</option>
                                    </select>
                                    <?php $__errorArgs = ['subject'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                                        <p class="mt-1 text-sm text-red-600"><?php echo e($message); ?></p>
                                    <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                                </div>
                            </div>
                        </div>

                        <!-- Message -->
                        <div>
                            <label for="message" class="block text-sm font-semibold text-gray-700 mb-2">
                                Message <span class="text-red-500">*</span>
                            </label>
                            <div class="relative">
                                <i data-lucide="message-square" class="absolute top-3 left-3 w-5 h-5 text-gray-400"></i>
                                <textarea
                                    id="message"
                                    name="message"
                                    rows="6"
                                    required
                                    class="w-full pl-10 pr-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-primary-500 focus:border-transparent transition-all duration-300 resize-none <?php $__errorArgs = ['message'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> border-red-500 <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>"
                                    placeholder="Tell us more about your inquiry..."
                                ><?php echo e(old('message')); ?></textarea>
                                <?php $__errorArgs = ['message'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                                    <p class="mt-1 text-sm text-red-600"><?php echo e($message); ?></p>
                                <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                            </div>
                            <p class="mt-1 text-sm text-gray-500">
                                <span x-text="$refs.messageTextarea ? $refs.messageTextarea.value.length : 0" x-ref="messageCount">0</span>/1000 characters
                            </p>
                        </div>

                        <!-- Priority -->
                        <div>
                            <label class="block text-sm font-semibold text-gray-700 mb-3">
                                Priority Level
                            </label>
                            <div class="grid grid-cols-1 md:grid-cols-3 gap-3">
                                <label class="relative flex items-center p-3 border border-gray-300 rounded-lg cursor-pointer hover:bg-gray-50 transition-colors duration-300 has-[:checked]:border-green-500 has-[:checked]:bg-green-50">
                                    <input type="radio" name="priority" value="low" <?php echo e(old('priority', 'normal') == 'low' ? 'checked' : ''); ?> class="sr-only peer">
                                    <div class="flex items-center">
                                        <div class="w-4 h-4 border-2 border-green-500 rounded-full mr-3 flex items-center justify-center">
                                            <div class="w-2 h-2 bg-green-500 rounded-full opacity-0 peer-checked:opacity-100 transition-opacity duration-300"></div>
                                        </div>
                                        <span class="text-sm font-medium text-gray-700">Low Priority</span>
                                    </div>
                                </label>
                                <label class="relative flex items-center p-3 border border-gray-300 rounded-lg cursor-pointer hover:bg-gray-50 transition-colors duration-300 has-[:checked]:border-yellow-500 has-[:checked]:bg-yellow-50">
                                    <input type="radio" name="priority" value="normal" <?php echo e(old('priority', 'normal') == 'normal' ? 'checked' : ''); ?> class="sr-only peer">
                                    <div class="flex items-center">
                                        <div class="w-4 h-4 border-2 border-yellow-500 rounded-full mr-3 flex items-center justify-center">
                                            <div class="w-2 h-2 bg-yellow-500 rounded-full opacity-0 peer-checked:opacity-100 transition-opacity duration-300"></div>
                                        </div>
                                        <span class="text-sm font-medium text-gray-700">Normal</span>
                                    </div>
                                </label>
                                <label class="relative flex items-center p-3 border border-gray-300 rounded-lg cursor-pointer hover:bg-gray-50 transition-colors duration-300 has-[:checked]:border-red-500 has-[:checked]:bg-red-50">
                                    <input type="radio" name="priority" value="high" <?php echo e(old('priority', 'normal') == 'high' ? 'checked' : ''); ?> class="sr-only peer">
                                    <div class="flex items-center">
                                        <div class="w-4 h-4 border-2 border-red-500 rounded-full mr-3 flex items-center justify-center">
                                            <div class="w-2 h-2 bg-red-500 rounded-full opacity-0 peer-checked:opacity-100 transition-opacity duration-300"></div>
                                        </div>
                                        <span class="text-sm font-medium text-gray-700">Urgent</span>
                                    </div>
                                </label>
                            </div>
                        </div>

                        <!-- Submit Button -->
                        <div class="pt-4">
                            <button
                                type="submit"
                                class="w-full bg-gradient-to-r from-primary-600 to-primary-700 text-white py-4 px-6 rounded-lg font-semibold hover:from-primary-700 hover:to-primary-800 transition-all duration-300 transform hover:scale-105 shadow-lg hover:shadow-xl disabled:opacity-50 disabled:cursor-not-allowed"
                                x-bind:disabled="submitting"
                                x-text="submitting ? 'Sending Message...' : 'Send Message'"
                            >
                                Send Message
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- FAQ Section -->
<section class="py-12 bg-white">
    <div class="container mx-auto px-4 sm:px-6 lg:px-8">
        <div class="text-center max-w-3xl mx-auto mb-12">
            <span class="inline-block px-4 py-2 bg-primary-100 text-primary-700 rounded-full text-sm font-semibold mb-4">
                <i data-lucide="help-circle" class="w-4 h-4 inline mr-1"></i>
                Frequently Asked Questions
            </span>
            <h2 class="text-3xl font-display font-bold text-gray-900 mb-4 leading-tight">
                Common Questions About <span class="gradient-text">Contacting Us</span>
            </h2>
            <p class="text-lg text-gray-600">
                Find quick answers to the most frequently asked questions about getting in touch with our team.
            </p>
        </div>

        <div class="max-w-3xl mx-auto" x-data="{ active: null }">
            <!-- FAQ Item 1 -->
            <div class="mb-4 border border-gray-200 rounded-xl overflow-hidden">
                <button
                    @click="active !== 1 ? active = 1 : active = null"
                    class="flex items-center justify-between w-full p-5 text-left bg-white hover:bg-gray-50"
                >
                    <span class="font-medium text-gray-900">How quickly will I receive a response?</span>
                    <i
                        data-lucide="chevron-down"
                        class="w-5 h-5 text-gray-500 transition-transform duration-300"
                        :class="active === 1 ? 'transform rotate-180' : ''"
                    ></i>
                </button>
                <div
                    x-show="active === 1"
                    x-transition:enter="transition ease-out duration-300"
                    x-transition:enter-start="opacity-0 transform -translate-y-4"
                    x-transition:enter-end="opacity-100 transform translate-y-0"
                    x-transition:leave="transition ease-in duration-300"
                    x-transition:leave-start="opacity-100 transform translate-y-0"
                    x-transition:leave-end="opacity-0 transform -translate-y-4"
                    class="p-5 bg-gray-50 border-t border-gray-200"
                >
                    <p class="text-gray-600">
                        We typically respond to all inquiries within 24 hours during business days. Urgent inquiries marked as "High Priority" are handled within 4-6 hours. For immediate assistance, you can call our phone number during business hours.
                    </p>
                </div>
            </div>

            <!-- FAQ Item 2 -->
            <div class="mb-4 border border-gray-200 rounded-xl overflow-hidden">
                <button
                    @click="active !== 2 ? active = 2 : active = null"
                    class="flex items-center justify-between w-full p-5 text-left bg-white hover:bg-gray-50"
                >
                    <span class="font-medium text-gray-900">What information should I include in my message?</span>
                    <i
                        data-lucide="chevron-down"
                        class="w-5 h-5 text-gray-500 transition-transform duration-300"
                        :class="active === 2 ? 'transform rotate-180' : ''"
                    ></i>
                </button>
                <div
                    x-show="active === 2"
                    x-transition:enter="transition ease-out duration-300"
                    x-transition:enter-start="opacity-0 transform -translate-y-4"
                    x-transition:enter-end="opacity-100 transform translate-y-0"
                    x-transition:leave="transition ease-in duration-300"
                    x-transition:leave-start="opacity-100 transform translate-y-0"
                    x-transition:leave-end="opacity-0 transform -translate-y-4"
                    class="p-5 bg-gray-50 border-t border-gray-200"
                >
                    <p class="text-gray-600">
                        Please include as much detail as possible about your inquiry. For celebrity bookings, mention the event date, location, type of event, and budget range. For technical issues, describe the problem you're experiencing and any error messages you see.
                    </p>
                </div>
            </div>

            <!-- FAQ Item 3 -->
            <div class="mb-4 border border-gray-200 rounded-xl overflow-hidden">
                <button
                    @click="active !== 3 ? active = 3 : active = null"
                    class="flex items-center justify-between w-full p-5 text-left bg-white hover:bg-gray-50"
                >
                    <span class="font-medium text-gray-900">Can I schedule a call with your team?</span>
                    <i
                        data-lucide="chevron-down"
                        class="w-5 h-5 text-gray-500 transition-transform duration-300"
                        :class="active === 3 ? 'transform rotate-180' : ''"
                    ></i>
                </button>
                <div
                    x-show="active === 3"
                    x-transition:enter="transition ease-out duration-300"
                    x-transition:enter-start="opacity-0 transform -translate-y-4"
                    x-transition:enter-end="opacity-100 transform translate-y-0"
                    x-transition:leave="transition ease-in duration-300"
                    x-transition:leave-start="opacity-100 transform translate-y-0"
                    x-transition:leave-end="opacity-0 transform -translate-y-4"
                    class="p-5 bg-gray-50 border-t border-gray-200"
                >
                    <p class="text-gray-600">
                        Absolutely! We offer phone consultations for complex bookings and event planning. When you submit your inquiry, mention that you'd like to schedule a call, and we'll coordinate a convenient time that works for both parties.
                    </p>
                </div>
            </div>
        </div>
    </div>
</section>

<script>
function contactForm() {
    return {
        submitting: false,

        init() {
            // Character counter for message textarea
            this.$refs.messageTextarea = document.getElementById('message');
            if (this.$refs.messageTextarea) {
                this.$refs.messageTextarea.addEventListener('input', () => {
                    this.$refs.messageCount.textContent = this.$refs.messageTextarea.value.length;
                });
            }
        }
    }
}
</script>

<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.base1', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /Users/user/Desktop/Websites/Broker/Celebrity/Celebrity/resources/views/home/contact.blade.php ENDPATH**/ ?>