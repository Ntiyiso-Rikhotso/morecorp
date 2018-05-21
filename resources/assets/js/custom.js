$(document)
    .ready(function () {
        $(document)
            .on('click', '.view-product', function () {
                var $product = $(this)
                    .closest('.product-info')
                var productId = $product.data('product-id')
                var $modal = $('.view-product-modal');
                var $modalBody = $modal.find('.modal-body');

                $modalBody.attr('product-id', productId);

                $modalBody.closest('.modal-content')
                    .LoadingOverlay("show"); //overlay

                $.ajax({
                    url: '/view_product/' + productId,
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]')
                            .attr('content')
                    },
                    success: function (response) {
                        $modalBody.html(response);
                        $modal.modal('show'); //show

                        $modalBody.closest('.modal-content')
                            .LoadingOverlay("hide"); //overlay

                    }
                });
            })

        $(document)
            .on('click', '.bid-now', function () {
                var $table = $(this)
                    .closest('table');
                $table.LoadingOverlay("show"); //overlay
                $.ajax({
                    url: '/bid_now/',
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]')
                            .attr('content')
                    },
                    success: function (response) {
                        $table.html(response)
                        $table.LoadingOverlay("hide"); //overlay
                    }
                })
            })

        $(document)
            .on('click', '.bid-submit', function (a) {

                a.preventDefault();

                var $modal = $(this)
                    .closest('.modal-body');
                productId = $modal.attr('product-id');
                
                var formData = $('#bid-now')
                    .serialize();
				isEmailValid = validateEmail($modal.find('[name=email]').val()); //validate email
				
			if(isEmailValid){
			if($modal.find('[name=amount]').val() != ''){
				$modal.closest('.modal-content')
                    .LoadingOverlay("show"); //overlay
				$(document).find('div.errors').hide();
                $.ajax({
                        url: '/bid/' + productId,
                        headers: {
                            'X-CSRF-TOKEN': $('meta[name="csrf-token"]')
                                .attr('content')
                        },
                        dataType: 'JSON',
                        method: 'POST',
                        data: formData,
                    })
                    .then(function () {
                        $.ajax({
                            url: '/view_product/' + productId,
                            headers: {
                                'X-CSRF-TOKEN': $('meta[name="csrf-token"]')
                                    .attr('content')
                            },
                            success: function (response) {
                                $modal.html(response);
                                $modal.modal('show'); //show

                                $modal.closest('.modal-content')
                                    .LoadingOverlay("hide"); //overlay

                            },
                            error: function (e, a) {
                                //alert(JSON.stringify(e)+ ' ' + JSON.stringify(a))
                            }
                        });
                    });
			}else{
				$(document).find('div.errors').html('Please enter bid amount!').slideDown();
			}	
			    }else{
					$(document).find('div.errors').html('Invalid email address, please enter a valid email address!').slideDown();
				}	
            })
    })
	
	function validateEmail(email) {
		var re = /^(([^<>()\[\]\\.,;:\s@"]+(\.[^<>()\[\]\\.,;:\s@"]+)*)|(".+"))@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\])|(([a-zA-Z\-0-9]+\.)+[a-zA-Z]{2,}))$/;
		return re.test(String(email).toLowerCase());
	}
	
	$(document)
            .on('click', '.manage-product', function (a) {
			
			var $tr = $(this).closest('tr');
			var productId = $tr.attr('product-id');
			var $modal = $('.modal');
                var $modalBody = $modal.find('.modal-body');
				$modalBody.closest('.modal-content')
                    .LoadingOverlay("show"); //overlay
			$.ajax({
				url : '/manage_product/'+ productId,
				headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]')
                            .attr('content')
                    },
				success: function(response){
					$modalBody.html(response);
                    $modal.modal('show'); //show
					$modalBody.closest('.modal-content')
                    .LoadingOverlay("hide"); //overlay
				}
			})
				
	})
	
	$(document)
            .on('click', '.edit-product', function (a) {
			$(this).removeClass('btn-info').removeClass('edit-product').addClass('btn-success save-data').html('update');
			$(this).find('hide-product').slideUp();
			var $table = $(this).closest('table');
			$table.find('tr').each(function(){
				var $tr = $(this);
					$tr.find('p.editable').slideUp()
					$tr.find('input').attr('hidden', false).attr('required', true).show()
			})
				
	})
	
	$(document)
            .on('click', '.save-data', function (a) {
			
			var $form = $(this).closest('form');
			var productId = $form.find('input[name=productId]').val();
			var $modal = $('.modal');
                var $modalBody = $modal.find('.modal-body');
				$modalBody.closest('.modal-content')
                    .LoadingOverlay("show"); //overlay
			$.ajax({
				url : '/update_product/'+ productId,
				headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]')
                            .attr('content')
                    },
				data: $form.serialize(),
				method: 'POST',
				success: function(response){
					$modalBody.html(response);
                    $modal.modal('show'); //show
					$modalBody.closest('.modal-content')
                    .LoadingOverlay("hide"); //overlay
				}
			})
				
	})
	