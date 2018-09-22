    <div class="col-lg-3 col-md-3 col-sm-4 col-xs-12">
            <div class="row row-margin">
                <div class="widget">
                        <!-- widget >>Search For Babysitter -->
                        <h4 class="widget-title">Find A Nanny</h4>
                        <p class="widget-tag">Already registered? <a href="/user/sign-in/login">Sign In</a></p>
                        <hr class="widget-hr">
                        <!-- form >>Search For Babysitter-->
                        <form action="/nannies/" method="get" class="form-search">
                            <div class="input-group">
                                <input type="text" placeholder="Enter Your Zip Code" value="<?= $_GET['zip'] ?? ''; ?>" name="zip" class="form-control">
                            </div>
                            <select class="select-picker select2-hidden-accessible" name="availability" tabindex="-1" aria-hidden="true">
                                <option selected="" disabled="" value="">Job Type</option>
                                <option value="1">Full Time</option>
                                <option value="2">Part Time</option>
                                <option value="3">Live In</option>
                                <option value="4">Babysitter</option>
                                <option value="5">Temporary</option>
                                <option value="6">Overnight Care</option>
                            </select>
                            <select class="select-picker select2-hidden-accessible" name="position" tabindex="-1" aria-hidden="true">
                                <option selected="" disabled="" value="">Type of Help</option>
                                <option value="1">Nanny</option>
                                <option value="2">Babysitter</option>
                                <option value="3">Newborn Specialist</option>
                                <option value="4">Special Needs</option>
                                <option value="5">Caregiver</option>
                                <option value="6">Housekeeper</option>
                            </select>
                            
                            <select class="select-picker select2-hidden-accessible" name="radius" tabindex="-1" aria-hidden="true">
                                <option selected="" disabled="" value="">Distance</option>
                                <option value="9999">Any Distance</option>
                                <option value="5">5 miles radius</option>
                                <option value="10">10 miles radius</option>
                                <option value="25">25 miles radius</option>
                                <option value="50">50 miles radius</option>
                            </select>
                            <button type="submit" class="btn btn-inverse">Search</button>
                        </form>
                </div>
            </div>
    </div>