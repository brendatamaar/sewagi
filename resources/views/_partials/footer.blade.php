<!-- start: footer -->
<footer class="section-content footer background-primary-dark pt-65 pb-33">
  <div class="container">
    <div class="row">
      <div class="col-xl-2 col-md-6 col-12 footer-links mr-xl-30 mb-15">
        <p class="text-footer-header mb-30">Services</p>
        <ul class="list-unstyled link-item">
            <li class="mb-10">
                <a href="#" class="color-white">Flexible renting</a>
            </li>
            <li class="mb-10">
                <a href="#" class="color-white">Property Marketing & Management</a>
            </li>
            <li class="mb-10">
                <a href="#" class="color-white">Realty Insurance</a>
            </li>
            <li class="mb-10">
                <a href="#" class="color-white">Co-Brokerage</a>
            </li>
        </ul>
      </div>
      <div class="col-xl-2 col-md-6 col-12 footer-links mr-xl-30 mb-15">
        <p class="text-footer-header mb-30">Company</p>
        <ul class="list-unstyled link-item">
          <li class="mb-10">
            <a href="#" class="color-white">About</a>
          </li>
        </ul>
      </div>
      <div class="col-xl-2 col-md-6 col-12 footer-links mr-xl-30 mb-15">
        <p class="text-footer-header mb-30">FYI</p>
        <ul class="list-unstyled link-item">
          <li class="mb-10">
            <a href="#" class="color-white">FAQ</a>
          </li>
          <li class="mb-10">
            <a href="#" class="color-white">Terms of use</a>
          </li>
          <li class="mb-10">
            <a href="#" class="color-white">Trust & Safety</a>
          </li>
          <li class="mb-10">
            <a href="#" class="color-white">Code of Conduct</a>
          </li>
        </ul>
      </div>
      <div class="col-xl-5 col-12 d-flex flex-column flex-wrap justify-content-start align-items-end footer-links pl-xl-50 mb-15">
        <div class="stay-connected w-100">
                        
            <p class="text-footer-header mb-30">FOUND A HOME YOU LIKE BUT NOT ON THE TERMS YOU WANT?</p>
          <button type="button" class="btn btn-primary btn-block" data-toggle="modal" data-target="#share-it-here-modal">Share it here and we'll make it happen</button>
          <div class="mt-30">
            <p class="text-footer-header py-5 mb-0">Subscribe to our newsletter!</p>
            <div class="form-get-subbed input-group mb-10">
              <input type="text" class="form-control" placeholder="What's your email?" aria-label="Text input with segmented dropdown button">
              <div class="input-group-prepend">
                <button type="button" class="btn btn-primary">Subscribe</button>
              </div>
            </div>
          </div>

        </div>
      </div>
    </div>

    <div class="row footer-bottom pt-35">
      <div class="col-md-6 col-12 d-flex align-items-center">
        <ul class="list-inline link-item footer-bottom-list mb-md-0">
          <li class="list-inline-item mr-50">
            <i class="fas fa-globe-asia color-white font-size-22 mr-10"></i> <a href="{{ url('set-lang/id') }}" class="color-white font-weight-light mr-15">Id</a> <a href="{{ url('set-lang/en') }}" class="color-white font-weight-light">En</a>
          </li>
          <li class="list-inline-item">
            <i class="fas fa-coins color-white font-size-22 mr-10"></i> <a href="#" class="color-white font-weight-light mr-15">{{ session('locale')=='id' ? 'RP' : 'IDR' }}</a> <a href="#" class="color-white font-weight-light">USD</a>
          </li>
        </ul>
      </div>
      <div class="col-md-6 col-12 copyright color-white" id="copyright">
        <div class="row align-items-center">
          <div class="col-6">
            <ul class="list-inline text-left mb-0">
              <li class="list-inline-item">
                <a href="https://www.facebook.com/colivingjakarta" class="mr-10 no-style icon" target="_blank">
                  <i class="fab icon-f__b color-white"></i>
                </a>
              </li>
              <li class="list-inline-item">
                <a href="#" class="mr-10 no-style icon" target="_blank">
                  <i class="fab icon-t__w color-white"></i>
                </a>
              </li>
              <li class="list-inline-item">
                <a href="https://www.instagram.com/colivingspaceindonesia" class="mr-10 no-style icon" target="_blank">
                  <i class="fab icon-i__ns color-white"></i>
                </a>
              </li>
              <li class="list-inline-item">
                <a href="https://www.youtube.com/channel/UC4MaMhPKZ0FOXDeb1X8FdJg" class="mr-10 no-style icon" target="_blank">
                  <i class="fab icon-y__t color-white"></i>
                </a>
              </li>
              <li class="list-inline-item">
                <a href="https://www.linkedin.com/company/sewagi" class="mr-10 no-style icon" target="_blank">
                  <i class="fab icon-l__in color-white"></i>
                </a>
              </li>
            </ul>
          </div>
          <div class="col-6">
            <img class="sewagi-copy" src="{{ asset('img/sewagi-logo-only.png') }}" alt="Sewagi Brand"> Sewagi &copy; 2019
            <!-- <script>
                document.getElementById('copyright').appendChild(document.createTextNode(new Date().getFullYear()))
            </script> -->
          </div>
        </div>
      </div>
    </div>
  </div>
</footer>
<!-- end: footer -->
