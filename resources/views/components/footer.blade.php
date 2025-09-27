<!-- Footer -->
<footer class="bg-white py-6">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-4">
            <!-- Company Info & Call Button -->
            <div>
                <div class="mb-3">
                    <img src="/img/logo/logo.jpg" alt="Bansal Immigration" class="h-12 sm:h-14 lg:h-16 w-auto object-contain mb-2">
                    <div class="text-sm text-sg-light-blue font-medium">MARA Registered Migration Agents</div>
                </div>
                
                <!-- Call Button -->
                <a href="tel:+61396021330" class="inline-flex items-center px-6 py-3 border-2 border-sg-light-blue text-sg-navy rounded-lg font-semibold hover:bg-sg-light-blue transition-colors duration-300 mb-2">
                    <i class="fas fa-phone mr-2 text-sg-light-blue"></i>Call +61 3 9602 1330
                </a>
                
				<p class="text-sg-navy text-sm mb-2">Please review our <a href="{{ route('terms-conditions') }}" class="text-sg-light-blue hover:underline">consultation Terms &amp; Conditions</a>.</p>
            </div>
            
            <!-- Services -->
            <div>
                <h3 class="text-lg font-semibold mb-3 text-sg-navy">Our Services</h3>
                <ul class="space-y-1 text-sm text-sg-navy">
                    <li><a href="/study-australia" class="hover:text-sg-light-blue transition-colors">Study in Australia</a></li>
                    <li><a href="/migrate-to-australia" class="hover:text-sg-light-blue transition-colors">Skilled Migration</a></li>
                    <li><a href="/family-visa" class="hover:text-sg-light-blue transition-colors">Partner Visas</a></li>
                    <li><a href="/visitor-visa" class="hover:text-sg-light-blue transition-colors">Visitor Visas</a></li>
                    <li><a href="/business-visas" class="hover:text-sg-light-blue transition-colors">Business Visas</a></li>
                    <li><a href="/employer-sponsored" class="hover:text-sg-light-blue transition-colors">Employer Sponsored</a></li>
                    <li><a href="/citizenship" class="hover:text-sg-light-blue transition-colors">Citizenship</a></li>
                    <li><a href="/appeals" class="hover:text-sg-light-blue transition-colors">Appeals & Reviews</a></li>
                </ul>
            </div>

            <!-- Company -->
            <div>
                <h3 class="text-lg font-semibold mb-3 text-sg-navy">Company</h3>
                <ul class="space-y-1 text-sm text-sg-navy">
					<li><a href="{{ route('about') }}" class="hover:text-sg-light-blue transition-colors">About Us</a></li>
					<li><a href="{{ route('team') }}" class="hover:text-sg-light-blue transition-colors">Our Team</a></li>
					<li><a href="{{ route('blogs') }}" class="hover:text-sg-light-blue transition-colors">Blog</a></li>
					<li><a href="{{ route('success-stories') }}" class="hover:text-sg-light-blue transition-colors">Success Stories</a></li>
					<li><a href="{{ route('contact') }}" class="hover:text-sg-light-blue transition-colors">Contact</a></li>
					<li><a href="{{ route('why-choose') }}" class="hover:text-sg-light-blue transition-colors">Why Choose Us</a></li>
                </ul>
            </div>

            <!-- Contact & Branches -->
            <div>
                <h3 class="text-lg font-semibold mb-3 text-sg-navy">Contact & Branches</h3>
                
                <!-- Melbourne Office -->
                <div class="mb-3">
                    <h4 class="text-sm font-semibold text-sg-navy mb-1">MELBOURNE</h4>
                    <div class="space-y-1 text-sm text-sg-navy">
                        <p class="flex items-start"><i class="fas fa-map-marker-alt mr-2 text-sg-light-blue mt-1"></i>Level 8/278 Collins St<br>Melbourne VIC 3000, Australia</p>
                        <p class="flex items-center text-sg-navy"><i class="fas fa-phone mr-2 text-sg-light-blue"></i><span class="text-sg-navy">+61 3 9602 1330</span></p>
						<p class="flex items-center"><i class="fas fa-envelope mr-2 text-sg-light-blue"></i><a href="mailto:info@bansalimmigration.com.au" class="hover:text-sg-light-blue transition-colors">info@bansalimmigration.com.au</a></p>
                    </div>
                </div>

                <!-- Adelaide Office -->
                <div class="mb-3">
                    <h4 class="text-sm font-semibold text-sg-navy mb-1">ADELAIDE</h4>
                    <div class="space-y-1 text-sm text-sg-navy">
                        <p class="flex items-start"><i class="fas fa-map-marker-alt mr-2 text-sg-light-blue mt-1"></i>Unit 5 5/55 Gawler Pl<br>Adelaide SA 5000, Australia</p>
                        <p class="flex items-center text-sg-navy"><i class="fas fa-phone mr-2 text-sg-light-blue"></i><span class="text-sg-navy">0400434884</span></p>
                        <p class="flex items-center"><i class="fas fa-envelope mr-2 text-sg-light-blue"></i><a href="mailto:adelaide@bansalimmigration.com.au" class="hover:text-sg-light-blue transition-colors">adelaide@bansalimmigration.com.au</a></p>
                    </div>
                </div>
            </div>
        </div>
        
        <!-- Bottom Footer -->
        <div class="border-t border-gray-300 mt-6 pt-4">
            <div class="flex flex-col md:flex-row justify-between items-center">
                <div class="text-sm text-sg-navy mb-2 md:mb-0">
                    <p>&copy; {{ date('Y') }} Bansal Immigration. All rights reserved. | MARA Registered Migration Agents</p>
                </div>
				<div class="flex space-x-6 text-sm text-sg-navy">
					<a href="{{ route('privacy-policy') }}" class="hover:text-sg-light-blue transition-colors">Privacy Policy</a>
					<a href="{{ route('terms-conditions') }}" class="hover:text-sg-light-blue transition-colors">Terms &amp; Conditions</a>
					<a href="{{ route('disclaimer') }}" class="hover:text-sg-light-blue transition-colors">Disclaimer</a>
					<a href="{{ route('cookie-policy') }}" class="hover:text-sg-light-blue transition-colors">Cookie Policy</a>
				</div>
            </div>
        </div>
    </div>
</footer>
