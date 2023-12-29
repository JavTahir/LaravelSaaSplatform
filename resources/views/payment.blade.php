@extends('dashboard')
@section('title','paymenttics')
@section('content')
<main class="p-4 md:p-8 payment_div">
<form id="purchaseForm" action="{{ route('confirmPurchase') }}" method="POST">
  @csrf
      <div class="row g-6">
        
        <div class="col-md-6">
          <div
            class="rounded-lg border shadow-sm text-black purple-color"
            style="height: 290px"
          >
            <div class="flex flex-col space-y-1.5 p-3 text-purple-700 bgg">
              <h3 class="text-2xl font-semibold purple-dark">Plan Details</h3>
            </div>
            <div class="p-3 space-y-4">
              <div class="d-flex justify-content-between">
              <span id="subscriptionPlanLabel">Subscription Plan for 30-days</span>

                <div
                  class="items-center bg-success border text-white"
                  style="
                    font-size: 12px;
                    border-radius: 20px;
                    width: 80px;
                    height: 24px;
                    padding-left: 5px;
                  "
                >
                  Current Plan
                </div>
              </div>

              <ul class="list-disc list-inside space-y-1 mt-4 text-muted" id="subscriptionDetails">
                <!-- Content will be dynamically populated here -->
              </ul>
              <select class="form-select" id="selectplan" aria-label="Default select example" onchange="updateSubscriptionDetails()">

                <option selected>Select a Plan</option>
                <option value="option1">Basic</option>
                <option value="option2">Gold</option>
                <option value="option3">Platinum</option>
              </select>
            </div>
          </div>
        </div>
        <div class="col-md-6 mb-3">
          <div
            class="rounded-lg border shadow-sm purple-color text-black"
            style="height: 290px"
          >
            <div
              class="flex flex-col bgg"
              style="padding-left: 15px; padding-top: 20px"
            >
              <h3 class="font-semibold purple-dark">User Details</h3>
            </div>
            <div class="p-3">
              <div class="form-group mb-3">
                <label for="email" class="form-label mb-1">Name</label>
                <input
                  type="text"
                  class="form-control"
                  id="email"
                  placeholder="Enter your Email"
                  style="border-radius: 6px"
                  name="email"
                  value="{{ auth()->user()->first_name }}"
                />
                <span id="emailError" class="error"></span>
              </div>

              <div class="form-group mb-2">
                <label for="password" class="form-label mb-1">Email</label>
                <input
                  type="text"
                  class="form-control"
                  id="password"
                  placeholder="Enter password"
                  style="border-radius: 6px"
                  name="password"
                  value="{{ auth()->user()->email }}"
                />
                <p style="width: 80%">
                  <span id="passwordError" class="error"></span>
                </p>
              </div>
            </div>
          </div>
        </div>
      </div>
      
      <div id="summaryDiv" class="rounded-lg border shadow-sm mt-6 purple-color text-black" style="display: none;">
        <div class="flex flex-col space-y-1.5 p-3 text-purple-700 bgg">
            <h3  class="text-2xl font-semibold purple-dark">Summary</h3>
        </div>
        <div class="p-3 space-y-4">
          <div class="d-flex justify-content-between mb-3">
          <span id="planName">Selected Subscription Plan</span>
            <span id="planPrice">$9.99/month</span>
          </div>
          <input type="hidden" id="selectedPlanInput" name="selectedPlan" value="">

          <button class="btn btn-primary">Confirm Purchase</button>
        </div>
      </div>
    </form>
    </main>


<script>

  // Initialize toastr
    toastr.options = {
        closeButton: true,
        progressBar: true,
        positionClass: 'toast-top-center',
        timeOut: 6000 // Time to close the toast in milliseconds (5 seconds in this example)
    };

    function updateSubscriptionDetails() {
        const selectedOption = document.getElementById('selectplan').value;
        const subscriptionDetails = document.getElementById('subscriptionDetails');
        const subscriptionPlanLabel = document.getElementById('subscriptionPlanLabel');
        var summaryDiv = document.getElementById("summaryDiv");
        var planPriceElement = document.getElementById("planPrice");
        var planNameElement = document.getElementById("planName");



        

        // Clear previous content
        subscriptionDetails.innerHTML = '';
        planPriceElement.innerHTML='';
        planNameElement.innerHTML='';

       

      

       

        @if(auth()->user()->plan_name )
            toastr.warning("You have already selected a plan. You can resubscribe when it expires.");

            return;
        @endif

        

        
        // Populate content based on selected option
        switch (selectedOption) {
            case 'option1':
                summaryDiv.style.display = "block";
                subscriptionPlanLabel.innerText = 'Bronze Subscription Plan';

                subscriptionDetails.innerHTML += '<li>Access to 5 postings in 24hrs</li>';
                subscriptionDetails.innerHTML += '<li>Postings on multiple accounts</li>';
                subscriptionDetails.innerHTML += '<li>Social handler analytics</li>';
                planNameElement.innerText += "Bronze Subscription Plan";
                planPriceElement.innerText += "$9.99/month"; // Adjust the price as needed
                break;
            case 'option2':
                summaryDiv.style.display = "block";
                subscriptionPlanLabel.innerText = 'Gold Subscription Plan';

                subscriptionDetails.innerHTML += '<li>Access to 15 postings in 24hrs</li>';
                subscriptionDetails.innerHTML += '<li>Postings on multiple accounts</li>';
                subscriptionDetails.innerHTML += '<li>Social handler analytics</li>';
                planNameElement.innerText += "Gold Subscription Plan";
                planPriceElement.innerText += "$14/month";
                break;
            case 'option3':
                summaryDiv.style.display = "block";
                subscriptionPlanLabel.innerText = 'Platinum Subscription Plan';

                subscriptionDetails.innerHTML += '<li>Unlimited access to postings in 24hrs</li>';
                subscriptionDetails.innerHTML += '<li>Postings on multiple accounts</li>';
                subscriptionDetails.innerHTML += '<li>Social handler analytics</li>';
                planNameElement.innerText = "Platinum Subscription Plan";
                planPriceElement.innerText = "$20/month";
                break;
            default:
                break;
               
               
  
          
      

            
        }

        document.getElementById('selectedPlanInput').value = selectedOption;



        
    }

    
</script>





@endsection()
