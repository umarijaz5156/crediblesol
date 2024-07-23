<div>
    <div class="p-4">
        <div class="my-2">
            @if (session('success'))
                <x-alerts.success :success="session('success')" />
            @endif
        </div>

        <div class="my-2">
            @if (session('error'))
                <x-alerts.error :error="session('error')" />
            @endif
        </div>
    
        <form wire:submit.prevent="payment" class="space-y-4">
            <div>
                <label for="item_name" class="block">Item Name</label>
                <input type="text" id="item_name" wire:model.defer="product_name" class="border rounded-md px-3 py-2 w-full">
            </div>
            <div>
                <label for="item_price" class="block">Item Price</label>
                <input type="number" id="item_price" wire:model.defer="price" class="border rounded-md px-3 py-2 w-full">
            </div>
            <div>
                <label for="ref_command" class="block">Reference Command</label>
                <input type="text" id="ref_command" wire:model.defer="refCommand" class="border rounded-md px-3 py-2 w-full">
            </div>
            <div>
                <label for="command_name" class="block">Command Name</label>
                <input type="text" id="command_name" wire:model.defer="commandName" class="border rounded-md px-3 py-2 w-full">
            </div>
          
            <button type="submit" class="bg-blue-500 mt-4 text-white rounded-md px-4 py-2 hover:bg-blue-600">Submit Payment</button>
        </form>
    </div>

    {{-- <button class="buy" onclick="buy(this)" data-item-id="88">Buy iPhone (450000 XOF)</button> --}}
    
    <script>
        function buy(btn) {
            var csrfToken = document.head.querySelector('meta[name="csrf-token"]').content;

            (new PayTech({
                some_post_data_1: 2, // Additional data to be sent to payment.php
                some_post_data_3: 4,
            })).withOption({
                requestTokenUrl: '/payment/token', 
                method: 'POST', 
                headers: {
                    'X-CSRF-TOKEN': csrfToken, // Include the CSRF token in the headers

                    "Accept": "text/html" // Additional headers
                },
                presentationMode: PayTech.OPEN_IN_POPUP, // Presentation mode
                 didGetToken: function (token, redirectUrl) {
                    console.log('Received non-success response:', token);

                    // Redirect the user to the payment page using the received token
                    window.location.href = redirectUrl;
                },
                didReceiveError: function (error) {
                    // Handle errors, e.g., display an error message to the user
                    console.error('An error occurred:', error);
                    alert('An error occurred. Please try again later.');
                },
                didReceiveNonSuccessResponse: function (jsonResponse) {
                    var tokenInfo = jsonResponse.token;

                    // Check if tokenInfo exists and contains the required data
                    if (tokenInfo) {
                        // Access the token and popup_script properties
                        var token = tokenInfo.original.token;
                        var popupScript = tokenInfo.original.popup_script;


                        // Log or handle the token and popup_script as needed
                        console.log('Received token:', token);
                        console.log('Received popup script:', popupScript);

                        // Optionally, open the popup window using the popup_script
                        if (popupScript) {
                            eval(popupScript);
                        }   
                    }
                },
                willGetToken: function () {
                    // Perform any preparations or actions before initiating the request
                    console.log('Preparing to get token...');
                }

            }).send();
        }

        
    </script>
    
    </div>
