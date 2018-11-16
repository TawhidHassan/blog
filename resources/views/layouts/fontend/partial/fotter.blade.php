<footer>
        <div class="container">
            <div class="row">

                <div class="col-lg-4 col-md-6">
                    <div class="footer-section">
                        <p class="copyright">{{config('app.name')}} @ 2017. All rights reserved.</p>
                        <p class="copyright">Designed by <a href="https://colorlib.com" target="_blank">Colorlib</a>devlop by sifat</p>
                        <ul class="icons">
                            <li><a href="#"><i class="material-icons">facebook</i></a></li>
                            <li><a href="#"><i class="material-icons">twitter</i></a></li>
                            <li><a href="#"><i class="material-icons">instagram</i></a></li>
                            <li><a href="#"><i class="material-icons">vimeo</i></a></li>
                            <li><a href="#"><i class="material-icons">pinterest</i></a></li>
                        </ul>

                    </div><!-- footer-section -->
                </div><!-- col-lg-4 col-md-6 -->

                <div class="col-lg-4 col-md-6">
                        <div class="footer-section">
                        <h4 class="title"><b>CATAGORIES</b></h4>
                        <ul>
                            @foreach($cartegory as $data)
                            <li><a href="{{route('category.posts',$data->slug)}}">{{$data->name}}</a></li>
                            @endforeach
                        </ul>
                        <ul>
                            <li><a href="#">SPORT</a></li>
                            <li><a href="#">DESIGN</a></li>
                            <li><a href="#">TRAVEL</a></li>
                        </ul>
                    </div><!-- footer-section -->
                </div><!-- col-lg-4 col-md-6 -->

                <div class="col-lg-4 col-md-6">
                    <div class="footer-section">

                        <h4 class="title"><b>SUBSCRIBE</b></h4>
                        <div class="input-area">
                            <form action="{{route('subscriber.store')}}" method="post">
                                @csrf
                                <input class="email-input" type="text" name="email" placeholder="Enter your email">
                                <button class="submit-btn" type="submit"><i class="material-icons">email</i></button>
                            </form>
                        </div>

                    </div><!-- footer-section -->
                </div><!-- col-lg-4 col-md-6 -->

            </div><!-- row -->
        </div><!-- container -->
    </footer>