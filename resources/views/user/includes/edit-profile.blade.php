<div id="defaultModal" tabindex="-1" aria-hidden="true" class="animate__animated hidden overflow-y-auto overflow-x-hidden fixed top-0 right-0 left-0 z-50 w-full md:inset-0 h-modal md:h-full">
     <div class="relative p-4 w-full max-w-2xl h-full md:h-auto">
          <!-- Modal content -->
          <div class="relative bg-white rounded-lg shadow drk:bg-gray-700">
               <!-- Modal header -->
               <div class="flex justify-between items-start p-4 rounded-t drk:border-gray-600">
                    <button type="button" class="text-gray-400 bg-transparent hover:bg-gray-200 hover:text-gray-900 rounded-lg text-sm p-1.5 ml-auto inline-flex items-center drk:hover:bg-gray-600 drk:hover:text-white" data-modal-toggle="defaultModal">
                         <svg aria-hidden="true" class="w-5 h-5" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg"><path fill-rule="evenodd" d="M4.293 4.293a1 1 0 011.414 0L10 8.586l4.293-4.293a1 1 0 111.414 1.414L11.414 10l4.293 4.293a1 1 0 01-1.414 1.414L10 11.414l-4.293 4.293a1 1 0 01-1.414-1.414L8.586 10 4.293 5.707a1 1 0 010-1.414z" clip-rule="evenodd"></path></svg>
                         <span class="sr-only">Close modal</span>
                    </button>
               </div>
               <!-- Modal body -->
               <div class="py-6 px-6 lg:px-8">
                    <div class="text-center">
                         <h3 class="mb-4 text-[20px] font-light text-[#5E6282] drk:text-white">Edit Profile</h3>
                         <div class="relative mx-auto bg-cover bg-no-repeat w-[80px] h-[80px] rounded-full flex justify-center items-center before:absolute before:content-[''] before:bg-black before:bg-opacity-20 before:top-0 before:left-0 before:bottom-0 before:right-0 before:rounded-full before:z[-1]" style="background-image: url({{asset('images/event-slider-img.svg')}})">
                              <img src="{{asset('images/edit-profile-logo.svg')}}" class="relative z-10 cursor-pointer" alt="">
                         </div>
                    </div>
                    <form class="space-y-6 mt-7" action="#" >
                         <div>
                              <label class='relative'>
                                   <input type="text" placeholder="Type" class='bg-white border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-[#A581F9] focus:border-[#A581F9] block w-full p-2.5 drk:bg-gray-600 drk:border-gray-500 drk:placeholder-gray-400 drk:text-white material-ui-inputs transition duration-200' />
                                   <span class='text-sm text-gray-400 bg-white absolute left-[10px] top-[10px] px-1 transition duration-200 input-text hover:cursor-text'>User name</span>
                                   <img src="{{asset('images/edit-inputs.svg')}}" class="absolute right-[14px] top-[14px] w-[17px]" alt="">
                              </label>
                         </div>
                         <div>
                              <label class='relative'>
                                   <input type="text" placeholder="Type" class='bg-white border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-[#A581F9] focus:border-[#A581F9] block w-full p-2.5 drk:bg-gray-600 drk:border-gray-500 drk:placeholder-gray-400 drk:text-white material-ui-inputs transition duration-200' />
                                   <span class='text-sm text-gray-400 bg-white absolute left-[10px] top-[10px] px-1 transition duration-200 input-text hover:cursor-text'>Email</span>
                                   <img src="{{asset('images/edit-inputs.svg')}}" class="absolute right-[14px] top-[14px] w-[17px]" alt="">
                              </label>
                         </div>
                         <div>
                              <label class='relative'>
                                   <input type="password" placeholder="Type" class='bg-white border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-[#A581F9] focus:border-[#A581F9] block w-full p-2.5 drk:bg-gray-600 drk:border-gray-500 drk:placeholder-gray-400 drk:text-white material-ui-inputs transition duration-200' />
                                   <span class='text-sm text-gray-400 bg-white absolute left-[10px] top-[10px] px-1 transition duration-200 input-text hover:cursor-text'>Password</span>
                                   <img src="{{asset('images/edit-inputs.svg')}}" class="absolute right-[14px] top-[14px] w-[17px]" alt="">
                              </label>
                         </div>
                         <div class="custom-select">
                              <select id="countries" class="bg-white border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-[#A581F9] focus:border-[#A581F9] block w-full p-2.5 drk:bg-gray-600 drk:border-gray-500 drk:placeholder-gray-400 drk:text-white transition duration-200">
                                   <option selected>Country</option>
                                   <option value="US">United States</option>
                                   <option value="CA">Canada</option>
                                   <option value="FR">France</option>
                                   <option value="DE">Germany</option>
                              </select>
                         </div>
                         <div>
                              <div class="text-[16px] font-normal text-[#A581F9] drk:text-gray-300">
                                   Select Your Gender
                              </div>
                              <div class="flex justify-start items-start gap-2 mt-[14px]">
                                   <div class="flex items-center p-[12px_11px] w-full rounded border border-gray-200 drk:border-gray-700 ">
                                        <input checked id="bordered-radio-1" type="radio" value="" name="bordered-radio" class="w-4 h-4 text-[#A581F9] bg-gray-100 border-gray-300 focus:ring-[#A581F9] drk:focus:ring-blue-600 drk:ring-offset-gray-800 focus:ring-2 drk:bg-gray-700 drk:border-gray-600">
                                        <label for="bordered-radio-1" class=" ml-2 w-full text-sm font-medium text-gray-900 drk:text-gray-300">Male</label>
                                   </div>
                                   <div class="flex items-center p-[12px_11px] w-full rounded border border-gray-200 drk:border-gray-700">
                                        <input  id="bordered-radio-2" type="radio" value="" name="bordered-radio" class="w-4 h-4 text-[#A581F9] bg-gray-100 border-gray-300 focus:ring-[#A581F9] drk:focus:ring-blue-600 drk:ring-offset-gray-800 focus:ring-2 drk:bg-gray-700 drk:border-gray-600">
                                        <label for="bordered-radio-2" class=" ml-2 w-full text-sm font-medium text-gray-900 drk:text-gray-300">Female</label>
                                   </div>
                                   <div class="flex items-center p-[12px_11px] w-full rounded border border-gray-200 drk:border-gray-700">
                                        <input  id="bordered-radio-3" type="radio" value="" name="bordered-radio" class="w-4 h-4 text-[#A581F9] bg-gray-100 border-gray-300 focus:ring-[#A581F9] drk:focus:ring-blue-600 drk:ring-offset-gray-800 focus:ring-2 drk:bg-gray-700 drk:border-gray-600">
                                        <label for="bordered-radio-3" class=" ml-2 w-full text-sm font-medium text-gray-900 drk:text-gray-300">Other</label>
                                   </div>
                              </div>
                         </div>
                         <button type="submit" class="w-full text-white bg-[#A581F9] hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-[#A581F9] font-normal rounded-lg text-[16px] px-5 py-3.5 text-center drk:bg-blue-600 drk:hover:bg-blue-700 drk:focus:ring-blue-800">Sign up</button>
                         <button type="submit" class="w-full text-[#5E6282]  focus:ring-4 focus:outline-none focus:ring-[#A581F9] font-normal rounded-lg text-[14px] px-5 py-3.5 text-center drk:bg-blue-600 drk:hover:bg-blue-700 drk:focus:ring-blue-800 flex justify-center items-center "><img src="{{asset('images/google.png')}}" class="mr-2" alt=""> Sign up with Google</button>
                    </form>
               </div>
          </div>
     </div>
</div>
