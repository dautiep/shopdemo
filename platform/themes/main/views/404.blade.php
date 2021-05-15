@php
    SeoHelper::setTitle(__('404 - Not found'));
    Theme::fire('beforeRenderTheme', app(\Platform\Theme\Contracts\Theme::class));
@endphp

{!! Theme::partial('header') !!}
<style>
    .error-code {
        color: #22292f;
        font-size: 3rem;
    }

    .error-border {
        background-color: var(--color-1st);
        height: .25rem;
        width: 6rem;
        margin-bottom: 1.5rem;
    }

    .error-page a {
        color: var(--color-1st);
    }

    .error-page ul li {
        margin-bottom : 5px;
    }
</style>

<!-- PAGE CONTENT START -->
<div class="section"> 
	<div class="line">
		<div class="fullwidth margin-bottom-40">
			<h1 class="text-center text-primary">Oops!</h1>
			<h2 class="text-center">The page you requested was not found</h2>
		</div>
		<div class="fullwidth">
			<p class="text-center padding-2x text-dark bordered-2">
			We suppose the dead pages were not what you were looking for. So please either go to our <a href="index.html" class="text-primary">Home Page</a> or try using the <a href="" class="text-primary">website search</a>.
			</p>
		</div>
	</div>
</div>
<!-- PAGE CONTENT END -->

{!! Theme::partial('footer') !!}


