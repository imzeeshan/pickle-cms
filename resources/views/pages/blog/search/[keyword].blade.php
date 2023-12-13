<?php
    use Modules\Posts\Entities\Category;
    use Modules\Media\Entities\Media;
    use Modules\Settings\Entities\Setting;
    use Modules\Posts\Entities\Post;

?>

<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8" />
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
        <meta name="description" content="" />
        <meta name="author" content="" />
        <title>{{env('APP_NAME')}}</title>
        <!-- Favicon-->
        <link rel="icon" type="image/x-icon" href="assets/favicon.ico" />
        <!-- Core theme CSS (includes Bootstrap)-->
        @vite(['resources/css/styles.css'])

    </head>
    <body>
        <!-- Responsive navbar-->
        <nav class="navbar navbar-expand-lg navbar-dark bg-dark">
            <div class="container">
            <a class="navbar-brand" href="/blog">{{env('APP_NAME')}}</a>
                <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation"><span class="navbar-toggler-icon"></span></button>
                <div class="collapse navbar-collapse" id="navbarSupportedContent">
                    <ul class="navbar-nav ms-auto mb-2 mb-lg-0">
                        <li class="nav-item"><a class="nav-link" href="/blog">Home</a></li>
                        <li class="nav-item"><a class="nav-link" href="#!">About</a></li>
                    </ul>
                </div>
            </div>
        </nav>
        <!-- Page header with logo and tagline-->
        <header class="py-5 bg-light border-bottom mb-4">
            <div class="container">
                <div class="text-center my-5">
                    <h1 class="fw-bolder">Welcome to {{ Setting::where('key','Site Title')->get()->pluck('value')->first() }} Blog!</h1>
                    <p class="lead mb-0">{{ Setting::where('key','Site Description')->get()->pluck('value')->first() }}</p>
                </div>
            </div>
        </header>
        <!-- Page content-->
        <div class="container">
            <div class="row">
                @php
                    $search_results = Post::search($keyword)->paginate(10);
                @endphp 

                <div class="col-lg-8">
                    <h3>Search Results : </h3>
                    <ol class="list-group list-group-numbered">
                    @foreach($search_results as $result)
                        <li class="list-group-item d-flex justify-content-between align-items-start">
                            <div class="ms-2 me-auto">
                            <div class="fw-bold"><a href="/blog/{{$result->id}}">{{$result->title}}</a></div>
                            {!! Str::limit($result->description, 700)!!}
                            </div>
                            <span class="badge bg-primary rounded-pill">{{$result->created_at}}</span>
                        </li>  
                        @endforeach             
                    </ol>

                    <!-- Pagination-->
                    <nav aria-label="Pagination">
                        <hr class="my-0" />
                        <ul class="pagination justify-content-center my-4">
                                {{$search_results->links()}}
                        </ul>
                    </nav>
                </div>

                <!-- Side widgets-->
                <div class="col-lg-4">
                    <!-- Search widget-->
                    <div class="card mb-4">
                        <div class="card-header">Search</div>
                        <div class="card-body">
                            <div class="input-group">
                                <form action="#" method="GET" id="search_form" name="search_form">
                                    <input id="keyword" name="keyword" class="form-control" type="text" placeholder="Enter search term..." aria-label="Enter search term..." aria-describedby="button-search" />
                                    <button class="btn btn-primary" id="button-search" type="button" onclick="search();">Go!</button>
                                </form>
                            </div>
                        </div>
                    </div>
                    <!-- Categories widget-->
                    <div class="card mb-4">
                        <div class="card-header">Categories</div>
                        <div class="card-body">
                            <div class="row">
                                <div class="col-sm-6">
                                    <ul class="list-unstyled mb-0">
                                        @php
                                           $categories = Category::all();
                                        @endphp

                                        @foreach($categories as $category)
                                            <li><a href="#!">{{$category->name}}</a></li>
                                        @endforeach
                                    </ul>
                                </div>                    
                            </div>
                        </div>
                    </div>
                    <!-- Side widget-->
                    <div class="card mb-4">
                        <div class="card-header">Latest Media</div>
                        <div class="card-body">
                            @php
                                $latest_media = Media::orderBy('created_at','asc')->limit(2)->get();
                            @endphp

                            @foreach($latest_media as $media)
                            <div class="card">
                              @if($media->type==0)
                                <a href="{{$media->url}}" target="_blank">
                                    <img class="card-img-top" src="{{$media->url}}" alt=" {{$media->title}}" width="100%" height="150" />                                  
                                </a>
                                <div class="card-body">
                                    <p class="card-text">  {{$media->title}} </p>
                                </div>                      
                              @else
                                <a href="{{$media->url}}" target="_blank">
                                    <video src="{{$media->url}}" controls  width="100%" height="150">   </video>                                 
                                </a>
                                <div class="card-body">
                                    <p class="card-text">  {{$media->title}} </p>
                                </div>
                              @endif
                            </div>
                            @endforeach
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- Footer-->
        <footer class="py-5 bg-dark">
            <div class="container"><p class="m-0 text-center text-white">Copyright &copy; {{env('APP_NAME')}} {{ Carbon\Carbon::now()->format('Y') }}</p></div>
        </footer>
        <!-- Bootstrap core JS-->
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js"></script>        
        <script>
            function search()
            {
                keyword                     = document.getElementById('keyword').value;
                document.search_form.action = "/blog/search/"+keyword;
                document.search_form.submit();
            }
        </script> 

    </body>
</html>
