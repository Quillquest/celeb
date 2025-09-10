@php
if (Auth('admin')->User()->dashboard_style == 'light') {
    $text = 'dark';
    $bg = 'light';
} else {
    $text = 'light';
    $bg = 'dark';
}
@endphp
@extends('layouts.app')
@section('content')
    @include('admin.topmenu')
    @include('admin.sidebar')
    <div class="main-panel ">
        <div class="content card">
            <div class="page-inner card-body ">
                <div class="mt-2 mb-4">
                    <h1 class="title1 text-{{ $text }} text-center">Create A New Shipment</h1>
                </div>
                <x-danger-alert />
                <x-success-alert />

                <div class="mb-5 row d-flex justify-content-center">
                    <div class="col-md-12">
                        <div class="card p-2 shadow ">
                            <div class="card-body">
                                <div>
                                    	<form method="POST" action="{{ route('createuser')}}" enctype="multipart/form-data">
													@csrf
													<div class="form-row">
                                                        <div class="form-group col-md-12">
															<h2 class="text-{{$text}} ">Recipient Information:</h2>
															
														</div>
                                                        <div class="form-group col-md-6">
															<h6 class="text-{{$text}}">Reciver's Full Name</h6>
															<input type="text" class="form-control bg-{{$bg}} text-{{$text}}" name="name"  placeholder="Recivers full name">
														</div>

                                                        
														<div class="form-group col-md-6">
															<h6 class="text-{{$text}}">Reciver's Email</h6>
															<input type="email" class="form-control bg-{{$bg}}  text-{{$text}}" placeholder="Recivers email" name="email" required>
														</div>
                                                        <div class="form-group col-md-6">
															<h6 class="text-{{$text}}"> Reciver's Phone Number</h6>
															<input type="text" class="form-control bg-{{$bg}} text-{{$text}}"  name="phone"  placeholder="Recivers Phone Number" required>
														</div>
                                                        <div class="form-group col-md-6">
                                                            <h6 class="text-{{ $text }}">Reciver's Contact Address</h6>
                                                            <input type="text" class="form-control bg-{{$bg}} text-{{ $text }}"
                                                                name="address" placeholder="Recivers  Contact Address"  required>
                                                        </div>

                                                        <div class="form-group col-md-12">
															<h6 class="text-{{$text}}">Recipient Country</h6>
															<select type="text" class="form-control bg-{{$bg}} text-{{$text}}" name="country" required>
                                                                @include('auth.countries')

                                                            </select>
														</div>
                                                        
                                                


                                                        <div class="form-group col-md-12">
															<h2 class="text-{{$text}} ">Sender Information:</h2>
															
														</div>
                                                        <div class="form-group col-md-6">
															<h6 class="text-{{$text}}">Sender Full Name</h6>
															<input type="text" class="form-control bg-{{$bg}} text-{{$text}}" name="sname"  placeholder="Sender Full Name">
														</div>

                                                        
														<div class="form-group col-md-6">
															<h6 class="text-{{$text}}">Sender Email</h6>
															<input type="email" class="form-control bg-{{$bg}}  text-{{$text}}" placeholder="Sender email" name="semail" required>
														</div>
                                                        <div class="form-group col-md-6">
															<h6 class="text-{{$text}}"> Sender Phone Number</h6>
															<input type="text" class="form-control bg-{{$bg}} text-{{$text}}"  name="sphone"  placeholder="Sender Phone Number" required>
														</div>
                                                        <div class="form-group col-md-6">
                                                            <h6 class="text-{{ $text }}">Sender Contact Address</h6>
                                                            <input type="text" class="form-control bg-{{$bg}} text-{{ $text }}"
                                                                name="saddress" placeholder="Sender Address"  required>
                                                        </div>

                                                        <div class="form-group col-md-12">
															<h6 class="text-{{$text}}">Sender Country</h6>
															<select type="text" class="form-control bg-{{$bg}} text-{{$text}}" name="scountry" required>
                                                                @include('auth.countries')

                                                            </select>
														</div>
														

                                                        
                                        


                                                        <div class="form-group col-md-12">
															<h2 class="text-{{$text}} ">Shipping Information:</h2>
															
														</div>
                                                        <div class="form-group col-md-6">
															<h6 class="text-{{$text}}">Take of Point</h6>
															<input type="text" class="form-control bg-{{$bg}} text-{{$text}}" name="take_off_point"  placeholder="Take of Point">
														</div>


                                                        <div class="form-group col-md-6">
															<h6 class="text-{{$text}}">Final Destination</h6>
															<input type="text" class="form-control bg-{{$bg}} text-{{$text}}" name="final_destination"  placeholder="Final Destination">
														</div>

                                                        <div class="form-group col-md-6">
                                                            <h6 class="text-{{ $text }}">Freight Type</h6>
                                                            <select type="text" class="form-control  bg-{{$bg}}  text-{{ $text }}"
                                                                name="freight_type"  required>
                                                                <option value="Air Freight">Air Freight</option> 
                                                                <option value="Sea Freight">Sea Freight</option> 
                                                                <option value="Road Freight">Road Freight</option> 
                                                                <option value="Rail Freight">Rail Freight</option> 
                                                               
                                                        </select>
                                                        </div>


                                                        <div class="form-group col-md-6">
                                                            <h6 class=" text-{{ $text }}">Shippment Content Type</h6>
                                                            <select type="text" class="form-control bg-{{$bg}}   text-{{ $text }}"
                                                                name="shipment_type"  required>
                                                                <option value="Parcel">Parcel</option>
                                                                <option value="Box">Box</option>
                                                                <option value="Document">Document</option>
                                                                <option value="Container">Container</option> 
                                                               
                                                        </select>
                                                        </div>

														<div class="form-group col-md-6">
															<h6 class="text-{{$text}}">Weight (eg 2kg)</h6>
															<input type="text" class="form-control bg-{{$bg}}  text-{{$text}}" placeholder="Weight" name="weight" required>
														</div>

                                                        <div class="form-group col-md-6">
                                                            <h6 class=" text-{{ $text }}">Shippment status</h6>
                                                            <select type="text" class="form-control bg-{{$bg}}   text-{{ $text }}"
                                                                name="status"  required>
                                                                <option data-value="Approved ">Approved </option>
                                                                <option data-value="Available">Available</option>
                                                                <option data-value="Cancelled">Cancelled</option>
                                                                <option data-value="Customs">Customs</option>
                                                                <option data-value="Delivered">Delivered</option>
                                                                <option data-value="Dispenser">Dispenser</option>
                                                                <option data-value="Distribution">Distribution</option>
                                                                <option data-value="Earring Collection">Earring Collection</option>
                                                                <option data-value="Effective">Effective</option>
                                                                <option data-value="In Transit">In Transit</option>
                                                                <option data-value="In warehouse">In warehouse</option>
                                                                <option data-value="Invoiced">Invoiced</option>
                                                                <option data-value="On Hold">On Hold</option>
                                                                <option data-value="On route">On route</option>
                                                                <option data-value="Packaged">Packaged</option>
                                                                <option data-value="Pending">Pending</option>													</select>
                                                               
                                                        </select>
                                                        </div>
                                                        <div class="form-group col-md-12"> 
															<h6 class="text-{{$text}}"> Breif Description of Shipment</h6>
															<textarea class="form-control bg-{{$bg}} text-{{$text}}  input-lg" name="description" rows="3" cols="4"> </textarea>
                                                            {{-- <input type="text" class="form-control bg-{{$bg}} text-{{$text}}  input-lg"  id="inputlg"  name="sphone"  placeholder="Sender Phone Number" required> --}}
														</div>
                                                        <div class="form-group col-md-6">
															<h6 class="text-{{$text}}">Date Shipped</h6>
															<input type="datetime-local" class="form-control bg-{{$bg}} text-{{$text}}" name="date_shipped" required>
														</div>

                                                        <div class="form-group col-md-6">
															<h6 class="text-{{$text}}">Expected Delivery Date</h6>
															<input type="datetime-local" class="form-control bg-{{$bg}} text-{{$text}}" name="expected_delivery" required>
														</div>
														


                                                        <div class="form-group col-md-6">
															<h6 class="text-{{$text}}">Tracking Number</h6>
															<input type="text" class="form-control bg-{{$bg}} text-{{$text}}" name="trackingnumber" value='{{ $trackingnumber }}' required>
														</div>
														

                                                       
                                                        
                                                        <div class="form-group col-md-6">
															<h6 class="text-{{$text}} text-danger">Shipment Current Location Address </h6>
															<input type="text" class="form-control bg-{{$bg}} text-{{$text}}" name="addresslocation" placeholder="Shipment Current Location" required>
														</div>
                                                        
                                                        <div class="form-group col-md-6">
															<h6 class="text-{{$text}} text-danger">Shipment Current City Or Country (This is the location that shows on the Map)</h6>
															<input type="text" class="form-control bg-{{$bg}} text-{{$text}}" name="location" placeholder="Shipment Current City or Country" required>
														</div>

                                                        <div class="form-group col-md-6">
                                                            <h6 class=" text-{{ $text }}">Turn On Video</h6>
                                                            <select type="text" class="form-control bg-{{$bg}}   text-{{ $text }}" name="videostatus"  required>
                                                                
                                                               <option data-value="On">On</option>
                                                                <option data-value="Off">Off</option>
                                                                                                                                      </select>
                                                                                                                     
                                                       </select>
                                                      </div>


                                                      <div class="form-group col-md-6">
                                                        <h6 class=" text-{{ $text }}">Select Video Type</h6>
                                                        <select type="text" class="form-control bg-{{$bg}}   text-{{ $text }}" name="videotype"  required>
                                                            
                                                           <option value="Money">Bricfcase of Money </option>
                                                            <option value="Gold">Box of Gold</option>
                                                                                                                                  </select>
                                                                                                                 
                                                   </select>
                                                  </div>

                                                        <div class="form-group col-md-6">
                                                            <h6 class="text-{{$text}} text-danger">Shipment Cost</h6>
                                                            <input type="number" class="form-control bg-{{$bg}} text-{{$text}}" name="cost"   placeholder="Enter Shipping Cost Amount" >
                                                        </div>
                                
                                                        <div class="form-group col-md-6">
                                                            <h6 class="text-{{$text}} text-danger"> Clearance Cost</h6>
                                                            <input type="number" class="form-control bg-{{$bg}} text-{{$text}}" name="clearance_cost"   placeholder="Enter  Clearance Cost" >
                                                        </div>
                                
                                                        <div class="form-group col-md-6">
                                                            <h6 class="text-{{$text}} text-danger"> QTY (eg 1, 2)</h6>
                                                            <input type="number" class="form-control bg-{{$bg}} text-{{$text}}" name="qty"   placeholder="Enter  QTY" >
                                                        </div>
                                
                                                        <div class="form-group col-md-6">
                                                            <h6 class="text-{{$text}} text-danger"> Delivery Percentage Completed</h6>
                                                            <input type="number" class="form-control bg-{{$bg}} text-{{$text}}" name="percentage_complete"   placeholder="Enter Delivery Percentage Completed" >
                                                        </div>
                                                        
                                                
                                                        </div>
                                                        
                                                       
														
                                                    <div class="form-group col-md-12">
                                                        <button type="submit" class="btn btn-primary">Generate Tracking</button>
                                                        </div>
												</form>  
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    
@endsection
