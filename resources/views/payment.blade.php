@extends('dashboard')
@section('title','paymenttics')
@section('content')
<main class="p-4 md:p-8 payment_div">
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
                <span>Basic Subscription Plan</span>
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

              <ul class="list-disc list-inside space-y-1 mt-4 text-muted">
                <li>Unlimited access to all features</li>
                <li>24/7 customer support</li>
                <li>Access to exclusive content</li>
              </ul>
              <select
                class="form-select"
                id="selectplan"
                aria-label="Default select example"
              >
                <option selected>Select a Plan</option>
                <option value="option1">Option 1</option>
                <option value="option2">Option 2</option>
                <option value="option3">Option 3</option>
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
              <h3 class="font-semibold purple-dark">Billing Information</h3>
            </div>
            <div class="p-3">
              <div class="form-group mb-3">
                <label for="email" class="form-label mb-1">Email</label>
                <input
                  type="email"
                  class="form-control"
                  id="email"
                  placeholder="Enter your Email"
                  style="border-radius: 6px"
                  name="email"
                />
                <span id="emailError" class="error"></span>
              </div>

              <div class="form-group mb-2">
                <label for="password" class="form-label mb-1">Password</label>
                <input
                  type="password"
                  class="form-control"
                  id="password"
                  placeholder="Enter password"
                  style="border-radius: 6px"
                  name="password"
                />
                <p style="width: 80%">
                  <span id="passwordError" class="error"></span>
                </p>
              </div>
            </div>
          </div>
        </div>
      </div>
      <div
        class="rounded-lg border shadow-sm mt-6 purple-color text-black mb-2"
      >
        <div class="flex flex-col space-y-1.5 p-3 text-purple-700 bgg">
          <h3 class="text-2xl font-semibold purple-dark">Payment Method</h3>
        </div>
        <div class="p-3 space-y-4">
          <div class="mb-3">
            <label for="cardname" class="form-label">Name on Card</label>
            <input
              type="text"
              class="form-control"
              id="cardname"
              value="John Doe"
              style="border-radius: 6px"
            />
          </div>
          <div class="mb-3">
            <label for="cardnumber" class="form-label">Card Number</label>
            <input
              type="text"
              class="form-control"
              id="cardnumber"
              value="xxxx xxxx xxxx 1234"
              style="border-radius: 6px"
            />
          </div>
          <div class="row g-2">
            <div class="col-md-6 mb-3">
              <label for="expiry" class="form-label">Expiry Date</label>
              <input
                type="text"
                class="form-control"
                id="expiry"
                value="MM/YY"
                style="border-radius: 6px"
              />
            </div>
            <div class="col-md-6 mb-3">
              <label for="cvv" class="form-label">CVV</label>
              <input type="text" class="form-control" id="cvv" value="***" style="border-radius: 6px"/>
              
            </div>
          </div>
        </div>
      </div>
      <div class="rounded-lg border shadow-sm mt-6 purple-color text-black">
        <div class="flex flex-col space-y-1.5 p-3 text-purple-700 bgg">
          <h3 class="text-2xl font-semibold purple-dark">Summary</h3>
        </div>
        <div class="p-3 space-y-4">
          <div class="d-flex justify-content-between mb-3">
            <span>Basic Subscription Plan</span>
            <span>$9.99/month</span>
          </div>
          <button class="btn btn-primary">Confirm Purchase</button>
        </div>
      </div>
    </main>





@endsection()
