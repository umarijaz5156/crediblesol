<footer class="bg-theme-blue pt-14">
    <div class="max-w-screen-xl mx-auto px-4">
      <div class="grid lg:grid-cols-12 gap-10 items-start">
        
        <div class="md:col-span-5">
          @php
          $settings = App\Models\Setting::get();
          $categories = App\Models\Category::get()->take(5);

          $logo = $settings->where('key', 'app_logo')->whereNotNull('value')->first();
      @endphp
          <img src="{{ asset($logo ? 'storage/'.$logo->value : 'images/img/logo.webp') }}" class="w-56" alt="" />
     
          <p class="text-white my-6">
            {{ ___("Explore a vast array of seafood options brought to you by FishApp. From the freshest catch to exotic delicacies,we're committed to delivering quality and flavor to your table. Dive into the world of seafood with FishApp today!") }}
        </p>
        
          
          <ul class="flex gap-x-4 items-center mt-4">
            <li>
              <a href="#"><img src="{{ asset('images/img/facebook.svg') }}" alt=""></a>
            </li>
            <li>
              <a href="#"><img src="{{ asset('images/img/instagram.svg') }}" alt=""></a>
            </li>
            <li>
              <a href="#"><img src="{{ asset('images/img/twitter.svg') }}" alt=""></a>
            </li>
          </ul>
        </div>
        
        <div class="md:col-span-2">
          <h3 class="text-white font-bold text-xl"> {{ ___('Quick Links') }} </h3>
          <ul class="text-white mt-4 flex flex-col gap-y-3">
            <li><a href="{{ route('about') }}"> {{ ___('About us') }} </a></li>

            <li><a href="{{ route('category.products') }}"> {{ ___('Products') }}</a></li>
            <li><a href="{{ route('sellers') }}"> {{ ___('Sellers') }} </a></li>
            <li><a href="{{ route('contactUs') }}" > {{ ___('Contact us') }} </a></li>
          </ul>
        </div>
        
        <div class="md:col-span-2">
          <h3 class="text-white font-bold text-xl">{{ ___('Legal') }}</h3>
          <ul class="text-white mt-4 flex flex-col gap-y-3">
            <li><a href="{{ route('privacy-policy') }}">{{ ___('Privacy Policy') }}</a></li>
            <li><a href="{{ route('terms') }}">{{ ___('Terms and Conditions') }}</a></li>
            
          </ul>
        </div>
        
        <div class="md:col-span-2">
          <h3 class="text-white font-bold text-xl">{{ ___('Categories') }}</h3>
          <ul class="text-white mt-4 flex flex-col gap-y-3">
            @forelse ($categories as $category)
            <li><a href="{{ route('category.products', Str::slug($category->title)) }}">{{ $category->title }}</a></li>
            
            @empty
            <li>{{ ___('No Category Found') }}</li>

            @endforelse
            
          </ul>
        </div>
      </div>
    </div>
    <div class="border-t border-[#e6e6e636] py-4 text-center text-white mt-8">
      <p> {{ ___('© 2024 by FishApp - All Rights Reserved') }}</p>
    </div>
  </footer>
  