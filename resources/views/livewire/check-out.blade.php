<div>
   <div class="container">
        <div class="row">
            <div class="col-sm-8">
<div class="card">
                <p class="heading pb-1 text-center">Delivery Address</p>
                <table class="table">
                    <tbody>
                        <tr class="table-success">
                            <td>Total Amount: <i class="fas fa-inr"></i> {{ Cart2::total() }}</td><td>Total Items: {{ Cart2::count() }}</td>
                        </tr>      
                    </tbody>

                </table>

                <form>
                    <div class="form-group">
                        <label>First Name</label>
                        <input type="text" class="form-control" id="firstname" 
                        name="firstname" 
                        placeholder="Enter First name..." 
                        wire:model="firstname" />
                @error('firstname') <div class="text-danger">{{ $message }}</div> @enderror
                        <br />
                    </div>

                    <div class="form-group">
                        <label>Last Name</label>
                        <input type="text" class="form-control" id="lastname" name="lastname" 
                        placeholder="Enter Last name..." 
                        wire:model="lastname" />
             @error('lastname') <div class="text-danger">{{ $message }}</div> @enderror
                        <br />
                    </div>

                    <div class="form-group">
                        <label>Address</label>
                        <textarea class="form-control" id="address" name="address" 
                        placeholder="Enter Address..." 
                        wire:model="address"></textarea>
             @error('address') <div class="text-danger">{{ $message }}</div> @enderror
                        <br />
                    </div>

                     <div class="form-group">
                        <label>Mobile No</label>
                        <input type="text" class="form-control" id="mobile" 
                        name="mobile" 
                        placeholder="Enter Mobile no..." 
                        wire:model="mobile" />
             @error('mobile') <div class="text-danger">{{ $message }}</div> @enderror
                        <br />
                    </div>
                </form>
                
                <br />
                <button class="btn btn-danger">Back </button>&nbsp;&nbsp;
                <button class="btn btn-success" wire:click="saveOrder">Place Order</button>

</div>
            </div>
            
        </div>
    </div>
</div>
