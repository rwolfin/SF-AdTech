<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <noscript><meta http-equiv="refresh" content="0; url=/noscript"></noscript>
        <title>{{env('APP_NAME')}}</title>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name='websocket' content="{{env('WEBSOCKET_ADDR')}}">       

        <!-- Fonts -->
        <link href="https://fonts.googleapis.com/css2?family=Nunito:wght@400;600;700&display=swap" rel="stylesheet">
        <!-- стили -->
        <link href="{{ asset('css/app.css') }}" rel="stylesheet">
        <link href="/css/welcome.css" rel="stylesheet" />
        <link href="/css/common.css" rel="stylesheet" />
        <!-- скрипты -->
        <script src="/js/websockets/ClientWebsocket.js" defer></script>
        <script src="/js/websockets/MainClientWebsocket.js" defer></script>
        <script src="/js/pages/main.js" defer></script>
        <script src="https://cdn.tailwindcss.com"></script>
    </head>

    <body>
        <header class="p-2">
            @if (Route::has('login'))
                <p class="text-end">
                    @auth
                        <a href="{{ route('dashboard') }}" class="btn-reference inline-block rounded border border-gray-600 px-6 pb-[6px] pt-2 text-xs font-medium uppercase 
                        leading-normal text-gray-600 transition duration-150 ease-in-out text-center w-48">Профиль</a>
                    @else
                        <div class="flex text-end mt-2 me-2">
                        <svg class="logo" width="200" height="17" viewBox="0 0 938 79" fill="none" xmlns="http://www.w3.org/2000/svg"><path fill-rule="evenodd" clip-rule="evenodd" d="M30.786 29.391l18.405 2.008c19.632 2.12 29.783 9.928 29.783 23.09 0 15.282-14.055 23.87-39.71 23.87C12.94 78.36 0 69.772 0 52.37h17.959c0 7.586 7.808 11.824 21.751 11.824 14.055 0 20.301-2.566 20.301-9.146 0-4.908-4.462-7.028-12.493-7.92L29.894 45.23C11.489 43.223 2.231 35.749 2.231 22.92 2.231 9.202 17.067.279 38.149.279c23.313 0 37.144 8.924 37.144 23.647H57.78c-.78-6.47-7.138-9.815-19.297-9.815-12.158 0-17.735 2.9-17.735 8.254 0 4.684 3.569 6.358 10.038 7.027zm520.806 33.575c-15.058 0-23.871-8.7-23.871-23.647s8.813-23.648 23.871-23.648c11.712 0 18.628 4.573 21.082 13.609h19.186C589.963 11.99 573.566.278 551.592.278c-26.214 0-43.279 15.393-43.279 39.04 0 23.76 16.954 39.042 43.279 39.042 22.866 0 38.818-12.159 40.491-30.787h-19.186c-1.115 9.705-8.923 15.393-21.305 15.393zm-104.956-16.62l13.712-35.917h.558l13.651 35.917h-27.921zm-.566-44.172l-28.333 74.29h17.402l6.174-16.175h38.543l6.147 16.174H505.3L476.856 2.174H446.07zm-278.083 0h-19.632l-28.89 29.337h-8.7V2.174H93.14v74.29h17.625V45.565h8.7l28.555 30.897h22.868L134.031 36.68l33.956-34.506zm49.749 0h17.625v60.012h40.156v14.277h-57.781V2.174zm87.229 0h-17.624v74.29h57.78V62.185h-40.156V2.174zm69.604 14.278h44.395V2.174h-62.019v74.29h17.624v-27.33h36.81V34.858h-36.81V16.452zM198.774 76.463H181.15V2.174h17.624v74.29zM699.836 2.174h44.968v17.067h-44.968V2.174zm0 17.067v40.156h-18.629V19.24h18.629zm44.968 0h18.628v40.156h-18.628V19.24zm76.52 18.962h-23.983V16.452h23.983c8.254 0 13.385 4.239 13.385 10.931 0 6.693-5.131 10.82-13.385 10.82zm31.679-10.82c0-15.504-12.048-25.209-31.679-25.209h-41.718v74.29h17.735V52.48h17.397l19.971 23.982h21.528l-22.749-27.32c12.323-2.963 19.515-10.729 19.515-21.76zm66.146-25.209l-21.082 33.017-21.082-33.017h-20.524l31.902 48.857v25.432h17.624V51.031L938 2.174h-18.851zM625.881 16.452h-27.886V2.174h73.508v14.278h-27.998v60.011h-17.624V16.452zm118.923 60.011h-44.968V59.397h44.968v17.066z" fill="#000"></path></svg>
                        <div class="auth-block">
                        <a href="{{ route('login') }}" class="btn-reference inline-block rounded border border-gray-600 px-6 pb-[6px] pt-2 text-xs font-medium uppercase 
                        leading-normal text-gray-600 transition duration-150 ease-in-out text-center w-48">Войти</a>

                            @if (Route::has('register'))
                                <a href="{{ route('register') }}" class="btn-reference inline-block rounded border border-gray-600 px-6 pb-[6px] pt-2 text-xs font-medium uppercase 
                        leading-normal text-gray-600 transition duration-150 ease-in-out text-center w-48">Регистрация</a>
                            @endif
                        </div>
                        </div>
                    @endauth
                </p>
            @endif
        </header>
        <!-- контент -->
        <main class="p-2">
            <section class="mx-auto section-content">
                <h3 class='text-center pb-8 text-3xl font-semibold'>Реферальные ссылки</h3>

                <section class="flex flex-wrap justify-around" id='section-ref-list'>
                    <!-- тестовая нерабочая ссылка -->
                    <article class='p-3 m-2 text-center bg-ddd color-333 shadow rounded text-xl w-80'>
                        <a href="?ref=1" class='font-semibold'>
                            <p title="{{env('APP_URL')}}?ref=1@1"> Тестовая<br> неработающая<br> ссылка </p>
                        </a>
                    </article>
                    
                    @for ($i = 0; $i < count($subscriptions); $i++)
                        <article class='p-4 m-2 text-center bg-ddd color-333 shadow rounded text-xl w-80 space-y-2' data-id='{{$subscriptions[$i]->id}}'>
                            <a href="?ref={{$subscriptions[$i]->refcode}}" class='font-semibold'>
                                <p title="{{$subscriptions[$i]->offer->url}}">{{$subscriptions[$i]->offer->name}}</p>
                            </a>
                            <p>веб-мастер: {{$subscriptions[$i]->follower->user->name}}</p>
                            <p>тема: {{$subscriptions[$i]->offer->theme->name}}</p>
                        </article>
                    @endfor
                </section>
            </section>
        </main>        
    </body>
</html>
