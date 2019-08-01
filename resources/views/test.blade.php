<form action="{{route('schedule-tours.post')}}" method="POST" id="form-register-community" class="w-100">
                <div class="form-group row">
                  <label class="col-sm-2 col-12 col-form-label">user</label>
                  <div class="col-sm-10 col-12">
                    <input type="text" name="user_id" id="txtFirstName" class="form-control">
                  </div>
                </div>
                <div class="form-group row">
                  <label class="col-sm-2 col-12 col-form-label">property</label>
                  <div class="col-sm-10 col-12">
                    <input type="text" name="property_id" id="txtLastName" class="form-control">
                  </div>
                </div>
                <div class="form-group row">
                  <label class="col-sm-2 col-12 col-form-label">bedroom</label>
                  <div class="col-sm-10 col-12">
                    <input type="text" name="bedroom_id" id="txtLastName" class="form-control">
                  </div>
                </div>
                <div class="form-group row">
                  <label class="col-sm-2 col-12 col-form-label">Living confition</label>
                  <div class="col-sm-10 col-12">
                    <select class="custom-select" name="living_condition">
                      <option selected></option>
                      <option value="co-living">co-living</option>
                      <option value="entire-space">entire-space</option>
                    </select>
                  </div>
                </div>
                <div class="form-group row">
                  <label class="col-sm-2 col-12 col-form-label">type tour</label>
                  <div class="col-sm-10 col-12">
                    <select class="custom-select" name="type_tour">
                      <option selected></option>
                      <option value="offline">offline</option>
                      <option value="virtual">virtual</option>
                    </select>
                  </div>
                </div>
                <div class="form-group row">
                  <label class="col-sm-2 col-12 col-form-label">length</label>
                  <div class="col-sm-10 col-12">
                    <input type="text" name="length" id="txtLastName" class="form-control">
                  </div>
                </div>
                <div class="form-group row">
                  <label class="col-sm-2 col-12 col-form-label">price</label>
                  <div class="col-sm-10 col-12">
                    <input type="text" name="price" id="txtLastName" class="form-control">
                  </div>
                </div>
                <div class="form-group row">
                  <div class="col-12 text-right">
                    <button id="btnSubmitRegisterCommunity" type="submit" class="btn btn-primary">Submit</button>
                  </div>
                </div>
                @csrf
              </form>