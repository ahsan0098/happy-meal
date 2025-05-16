<section class="page-title">
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-lg-8">
                <div class="hero-text text-center py-5 my-5">
                    <h1 class="text-white text-capitalize mb-2">{{$title}}</h1>
                    <div class="d-flex justify-content-center">
                        <a wire:navigate href="{{ route('home') }}" class="text-decoration-none red-text fs-4">Home</a> <span class="text-white fs-4 mx-2">/</span>
                        <p class="text-white fs-4">{{$title}}</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>