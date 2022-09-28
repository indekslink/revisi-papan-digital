<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Visual Content Papan Digital Tikusan</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-gH2yIJqKdNHPEq0n4Mqa/HGKIhSkIHeL5AyhkYV8i59U5AR6csBvApHHNl/vI1Bx" crossorigin="anonymous">


    <link rel="stylesheet" href="/vendor/owl-carousel/dist/assets/owl.carousel.min.css">
    <link rel="stylesheet" href="/vendor/owl-carousel/dist/assets/owl.theme.default.min.css">

    <link rel="stylesheet" href="/visual-content/style.css">
    <style>
        .owl-carousel .owl-stage {
            display: flex;
        }


        .owl-carousel .owl-stage .owl-item img {
            min-height: 100%;
            object-fit: contain;
        }
    </style>
</head>

<body>

    <div id="parent-view" class="carousel slide carousel-dark" data-bs-ride="false">
        <div class="carousel-inner">
            @foreach($presentation as $item)
            <div data-type="{{$item->sheet->content_type}}" class="carousel-item {{ $loop->iteration == 1 ? 'active' : '' }}">
                <div class="header text-center">
                    <div class="display-4 fw-bold">{{$item->sheet->title}}</div>
                    <div class="fs-2">{{$item->sheet->subtitle}}</div>
                </div>
                <div class="container-fluid content pt-5">

                    @if($item->sheet->content_type == 'classic')
                    {!! $item->sheet->content !!}
                    @else
                    <div class="data-src" data-src="{{$item->sheet->content}}"></div>

                    <div class="owl-carousel">
                        @foreach(json_decode($item->sheet->content) as $img)
                        <img src="/img/{{$img}}" alt="gambar">
                        @endforeach
                    </div>
                    </ul>
                    @endif

                </div>
            </div>
            @endforeach
        </div>
        <button class="carousel-control-prev" type="button" data-bs-target="#parent-view" data-bs-slide="prev">
            <span class="carousel-control-prev-icon" aria-hidden="true"></span>
            <span class="visually-hidden">Previous</span>
        </button>
        <button class="carousel-control-next" type="button" data-bs-target="#parent-view" data-bs-slide="next">
            <span class="carousel-control-next-icon" aria-hidden="true"></span>
            <span class="visually-hidden">Next</span>
        </button>
    </div>


    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0/dist/js/bootstrap.bundle.min.js" integrity="sha384-A3rJD856KowSb7dwlZdYEkO39Gagi7vIsF0jrRAoQmDKKtQBHUuLZ9AsSv4jD4Xa" crossorigin="anonymous"></script>


    <script src="https://code.jquery.com/jquery-3.6.1.min.js" integrity="sha256-o88AwQnZB+VDvE9tvIXrMQaPlFFSUTR+nldQm1LuPXQ=" crossorigin="anonymous"></script>

    <script src="/vendor/owl-carousel/dist/owl.carousel.min.js"></script>

    <script>
        const myCarousel = document.getElementById('parent-view')

        myCarousel.addEventListener('slide.bs.carousel', event => {
            const carouselActive = event.relatedTarget;
            const type = carouselActive.getAttribute('data-type');

            if (type == 'gallery') {
                setTimeout(() => {
                    runAnimationGallery(carouselActive);

                }, 1000);
            } else {
                clearInterval(runInterval);
            }
        })
        let runInterval = null;

        function runAnimationGallery(carousel) {
            const previewContent = carousel.children[1].children[0];
            const header = carousel.children[0];
            const getSrc = JSON.parse(previewContent.getAttribute('data-src'));
            const heightContent = window.innerHeight - header.offsetHeight;
            console.log(header.clientHeight)

            var owl = $('.owl-carousel');
            owl.owlCarousel({
                items: 5,
                loop: true,
                margin: 20,
                stagePadding: 50,
                autoplay: true,
                nav: false,
                // autoplayHoverPause: true,
                autoplayTimeout: 5000,
                autoplaySpeed: 5000,
                slideTransition: 'linear',
            });



            document.querySelectorAll('.owl-carousel .owl-stage .owl-item').forEach(e => {
                e.style.minHeight = `${heightContent-100}px`
            })
        }



        function cekFirstCarousel() {
            const getType = document.querySelector('.carousel-item.active');
            if (getType.getAttribute('data-type') == 'gallery') {
                runAnimationGallery(getType)
            }
        }
        cekFirstCarousel();
    </script>
</body>

</html>