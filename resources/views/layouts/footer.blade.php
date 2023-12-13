<footer class="footer footer-transparent d-print-none">
    <div class="container-xl">
      <div class="row text-center align-items-center flex-row-reverse">
        <div class="col-lg-auto ms-lg-auto">
          <ul class="list-inline list-inline-dots mb-0">
            <li class="list-inline-item">
              Copyright &copy; {{\Carbon\Carbon::now()->format('Y')}}
              <a href="." class="link-secondary">{{ env('APP_NAME') }}</a>.
              All rights reserved.
            </li>           
          </ul>
        </div>
      </div>
    </div>
  </footer>