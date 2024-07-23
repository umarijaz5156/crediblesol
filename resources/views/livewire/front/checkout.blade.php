<div>
    <section>
        <div class="container mx-auto ">
            <div class="">
                <div class="grid grid-cols-1 md:grid-cols-4 gap-4">
                    <div class=" mt-32 bg-[#f6f6f6] rounded-b-lg">
                    </div>
                </div>
            </div>
        </div>
    </section>

    <section>
        <div class="flex max-w-screen-xl lg:px-10 px-4  flex-col items-center justify-center py-14 mx-auto ">
          
          <div class="w-full ">
            <div class="lg:p-6 ">
              
              <form class="space-y-4 md:space-y-6" action="#">
                
                <div class="grid max-auto justify-center lg:grid-cols-12 lg:gap-x-20">
                  <div class="col-span-6"> 
    
                    <div class="pb-4 flex items-center gap-4 pt-4 w-full">
                        <div class="w-full">
                            <label for="firstname" class="text-sm text-theme-blue font-bold block pb-2">First Name</label>
                            <input class="appearance-none border rounded-full w-full py-4 px-6 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" id="username" type="text" placeholder="Username">
                            
                        </div>
                        <div class="w-full">
                            <label for="lastname" class="text-sm text-theme-blue font-bold block pb-2">Last Name</label>
                            <input class="appearance-none border rounded-full w-full py-4 px-6 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" id="username" type="text" placeholder="Username">
                              
                        </div>
                       
                    </div>    
    
                    <div class="w-full pb-4">
                        <label for="firstname" class="text-sm text-theme-blue font-bold block pb-2">Card Number</label>
                        <div class="relative">
                            <input class="appearance-none border rounded-full w-full py-4 px-6 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" type="text" placeholder="1234 1234 1234 1234">
                        <img src="{{ asset('images/img/card-icon.png') }}" alt="" class="absolute right-8 top-2 ">
                        </div>
                       
                    </div>
                    <div class="pb-4 flex items-center gap-4  w-full">
                        <div class="w-full">
                            <label for="firstname" class="text-sm text-theme-blue font-bold block pb-2">Expiry</label>
                            <input class="appearance-none border rounded-full w-full py-4 px-6 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" id="expiry" type="text" placeholder="MM/YY">
                            
                        </div>
                        <div class="w-full">
                            <label for="lastname" class="text-sm text-theme-blue font-bold block pb-2">CVC</label>
                            <div class="relative">
                                <input class="appearance-none border rounded-full w-full py-4 px-6 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" type="text" placeholder="CVC">
                            <img src="{{ asset('images/img/cvc.png') }}" alt="" class="absolute right-8 top-2 ">
                            </div>
                              
                        </div>
                       
                    </div> 
                    <div class="pb-4">
                        <label for="lastname" class="text-sm text-theme-blue font-bold block pb-2">Country</label>
                      <input class="appearance-none border rounded-full w-full py-4 px-6 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" id="password" type="text" placeholder="Country">
                    </div>
    
                    
                    <div class="pb-4">
                      <button type="submit" class="text-white bg-theme-red border border-theme-red focus:outline-none font-medium rounded-full text-sm px-10 py-4 w-full">
                        Pay Now
                      </button>
                    </div>
                    
                    
                  </div>
                  
                  <div class="col-span-6">
                  
                    <div class="border rounded-3xl p-8">
                        <h2 class="text-[#222222] text-lg font-bold pb-2 mb-4">Order Summary</h2>
                        
                        <ul class="flex flex-col gap-5">
                            <li class="flex items-center gap-3 justify-between">
                              <div class="flex items-center text-sm text-[#828282] font-semibold gap-3">
                               <img src="{{ asset('images/img/checkout.webp') }}" alt="" class="object-cover h-10 w-10 rounded-md"> <span>Product 1</span>
                              </div>
                              <p>9.99 $</p>
                            </li>
                           
                        </ul>
    
                        <div class="border-t mt-8 py-4 flex justify-between">
                            <p class="text-sm text-[#727B9D] font-semibold">Subtotal</p>
                            <b>$9.99</b>
                        </div>
                        <div class="border-t  pt-4 flex justify-between">
                            <p class="text-sm text-[#727B9D] font-semibold">Total</p>
                            <b>$9.99</b>
                        </div>
                    </div>
    
                    <div class="flex gap-3 mt-5">
                     <img src="{{ asset('images/img/warning.png') }}" alt="" class="min-w-4 h-4 mt-1"> 
                     <p class="text-sm text-[#ABABAB] font-medium">By providing your card information, 
                      you allow FishApp to charge your card for future payments in accordance with their terms</p>
                    </div>
    
                   
                  </div>
                  
                </div>
                
                
                
              </form>
            </div>
          </div>
        </div>
      </section>
      
</div>
