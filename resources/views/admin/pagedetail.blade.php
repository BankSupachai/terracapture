@isset($_GET['log'])
    @php
        $viewFactory = view() ; // app('view')
        $finder = $viewFactory->getFinder();
        $viewsProperty = (new ReflectionObject($finder))->getProperty('views');
        $viewsProperty->setAccessible(true);
        $views = $viewsProperty->getValue($finder);
    @endphp
    <script>
        console.log("{{str_replace("\\","/",Route::current()->action['controller'])}}");

        @foreach($views as $key =>$value)
            console.log("{{str_replace(".","/",$key)}}");
        @endforeach
    </script>
@endisset
