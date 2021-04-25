<div id="Mask"></div>
        <script src="JS/home.js"></script>
        <!-- Callout -->
        <div class="Callout Wide" id="SearchArea">
            <div class="Brand">
                Brand
                <a href="signin.php"> Sign In </a>
                <a href="register.php"> Register </a>
            </div>

            <div class="Extras">
                <span id="Account"><i class="fa fa-user"></i></span>  
            </div>
        </div>
        <!-- Banner -->
        <div class="Banner Wide">
            <div class="Inner">
                <div class="Text">
                    What are you looking for?
                </div>

                <div class="Search-Form">
                    <form action="searchResults.php" method="POST">
                        <span id="Filter"><i class="fa fa-sort"></i></span>
                        <input type="text" placeholder="Type your search here..." name="search-word" required />
                        <button type="submit" name="search-btn"> <i class="fa fa-search"></i> </button>

                        <div class="Search-Categories">
                            <span id="closeMenu"><i class="fa fa-times-circle"></i></span>
                           <div class="Header-Text">
                                All Categories
                           </div>

                            <ul>
                               <li><input class="radioBtn" type="radio" name="categories" value="vehicles"/> <span class="Label">Vehicles</span></li>
                               <li><input class="radioBtn" type="radio" name="categories" value="electronics"/> <span class="Label">Electronics</span></li>
                               <li><input class="radioBtn" type="radio" name="categories" value="computers"/> <span class="Label">Computers</span></li>
                               <li><input class="radioBtn" type="radio" name="categories" value="fashion"/> <span class="Label">Fashion</span></li>
                               <li><input class="radioBtn" type="radio" name="categories" value="health"/> <span class="Label">Health</span></li>
                               <li><input class="radioBtn" type="radio" name="categories" value="home"/> <span class="Label">Home</span></li>
                               <li><input class="radioBtn" type="radio" name="categories" value="jobs"/> <span class="Label">Jobs</span></li>
                               <li><input class="radioBtn" type="radio" name="categories" value="phones"/> <span class="Label">Phones</span></li>
                               <li><input class="radioBtn" type="radio" name="categories" value="services"/> <span class="Label">Services</span></li>
                               <li><input class="radioBtn" type="radio" name="categories" value="supermarket"/> <span class="Label">Supermarket</span></li>
                            </ul>
                        </div>
                    </form>
                </div>
                
            </div>
        </div>