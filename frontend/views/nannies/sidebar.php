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
                                <input type="text" placeholder="Enter Your Zip Code" value="<?= $_GET['zip'] ?? '';?>" name="zip" class="form-control">
                            </div>
<!--                            <select class="select-picker select2-hidden-accessible" required="" name="position" tabindex="-1" aria-hidden="true">-->
<!--                                <option selected="" disabled="" value="">Looking for</option>-->
<!--                                <option value="1">Part Time Nanny</option>-->
<!--                                <option value="2">Full Time Nanny</option>-->
<!--                                <option value="3">Live-in Nanny</option>-->
<!--                                <option value="4">Babysitter</option>-->
<!--                                <option value="5">Newborn Specialist</option>-->
<!--                                <option value="6">Caregiver</option>-->
<!--                                <option value="7">Housekeeper</option>-->
<!--                                <option value="8">Special Needs Nanny</option>-->
<!--                                <option value="9">Elderly Care</option>-->
<!--                            </select>-->
                            <select class="select-picker select2-hidden-accessible" required="" name="position" tabindex="-1" aria-hidden="true">
                                <option selected="" disabled="" value="">Job Type</option>
                                <option value="1">Part Time Nanny</option>
                                <option value="2">Full Time Nanny</option>
                                <option value="3">Live-in Nanny</option>
                                <option value="4">Occasional</option>
                                <option value="">Temporary</option>
                                <option value="">Overnight Care</option>
                            </select>
                            <select class="select-picker select2-hidden-accessible" required="" name="position" tabindex="-1" aria-hidden="true">
                                <option selected="" disabled="" value="">Type of Help</option>
                                <option value="">Nanny</option>
                                <option value="4">Babysitter</option>
                                <option value="5">Newborn Specialist</option>
                                <option value="6">Caregiver</option>
                                <option value="7">Housekeeper</option>
                                <option value="8">Special Needs Nanny</option>
<!--                                <option value="9">Elderly Care</option>-->
                            </select>
                            
                            <select class="select-picker select2-hidden-accessible" required="" name="radius" tabindex="-1" aria-hidden="true">
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