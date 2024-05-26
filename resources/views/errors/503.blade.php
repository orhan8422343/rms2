<html lang="ar" dir="ltr">
	<head>
        <title>{{$bs->website_title}} - maintenance Mode</title>
		<!-- favicon -->
		<link rel="shortcut icon" href="{{asset('assets/front/img/'.$bs->favicon)}}" type="image/x-icon">
		<!-- bootstrap css -->
		<link rel="stylesheet" href="{{asset('assets/front/css/bootstrap.min.css')}}">
		<link rel="stylesheet" href="{{asset('assets/front/css/503.css')}}">
	</head>
	<body>
		<div class="container" dir="rtl">
			<div class="content">
				<div class="row">
					<div class="col-lg-4 offset-lg-4">
						<div class="maintain-img-wrapper">
							<img src="{{asset('assets/front/img/maintenance.png')}}" alt="">
						</div>
					</div>
				</div>
				<div class="row">
					<div class="col-lg-8 offset-lg-2">
						<h3 class="maintain-txt ">
							{!! replaceBaseUrl(nl2br($bs->maintenance_text)) !!}
						</h3>
					</div>
				</div>
			</div>
		</div>
	</body>
</html>
