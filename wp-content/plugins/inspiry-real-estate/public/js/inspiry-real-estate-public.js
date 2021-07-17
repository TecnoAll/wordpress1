(function($) {
	'use strict';

	/*----------------------------------------------------------------------------------*/
	/* Contact Form AJAX validation and submission
	/* Validation Plugin : http://bassistance.de/jquery-plugins/jquery-plugin-validation/
	/* Form Ajax Plugin : http://www.malsup.com/jquery/form/
	/*---------------------------------------------------------------------------------- */

	if (jQuery().validate && jQuery().ajaxSubmit) {

		var submitButton = $('#submit-button'),
			ajaxLoader = $('#ajax-loader'),
			messageContainer = $('#message-container'),
			errorContainer = $("#error-container");

		var formOptions = {
			beforeSubmit : function() {
				submitButton.attr('disabled', 'disabled');
				ajaxLoader.fadeIn('fast');
				messageContainer.fadeOut('fast');
				errorContainer.fadeOut('fast');
			},
			success : function(ajax_response, statusText, xhr, $form) {
				var response = $.parseJSON(ajax_response);
				ajaxLoader.fadeOut('fast');
				submitButton.removeAttr('disabled');
				if (response.success) {
					$form.resetForm();
					messageContainer.html(response.message).fadeIn('fast');
				}
				else {
					errorContainer.html(response.message).fadeIn('fast');
				}
			}
		};

		$('#contact-form').each(function() {
			$(this).validate({
				errorLabelContainer : errorContainer,
				submitHandler : function(form) {
					$(form).ajaxSubmit(formOptions);
				}
			});
		});


		/*-----------------------------------------------------------------------------------*/
		/*	Agent's Contact Form
		 /*----------------------------------------------------------------------------------*/

		var agentFormOptions = {
			beforeSubmit : function(formData, jqForm, options) {
				var currentForm = $(jqForm[0]);
				currentForm.find('.agent-submit').attr('disabled', 'disabled');
				currentForm.find('.agent-loader').fadeIn('fast');
				currentForm.find('.agent-message').fadeOut('fast');
				currentForm.find('.agent-error').fadeOut('fast');
			},
			success : function(ajax_response, statusText, xhr, $form) {
				var response = $.parseJSON(ajax_response);
				$form.find('.agent-loader').fadeOut('fast');
				$form.find('.agent-submit').removeAttr('disabled');
				if (response.success) {
					$form.resetForm();
					$form.find('.agent-message').html(response.message).fadeIn('fast');
				}
				else {
					$form.find('.agent-error').html(response.message).fadeIn('fast');
				}
			}
		};

		$('.agent-form').each(function() {
			$(this).validate({
				errorLabelContainer : $(this).find('.agent-error'),
				submitHandler : function(form) {
					$(form).ajaxSubmit(agentFormOptions);
				}
			});
		});

		/*-----------------------------------------------------------------------------------*/
		/*	AJAX Login Form
		 /*----------------------------------------------------------------------------------*/

		var loginButton = $('#login-button'),
			loginAjaxLoader = $('#login-loader'),
			loginError = $("#login-error"),
			loginMessage = $('#login-message');

		var loginOptions = {
			beforeSubmit : function() {
				loginButton.attr('disabled', 'disabled');
				loginAjaxLoader.fadeIn('fast');
				loginMessage.fadeOut('fast');
				loginError.fadeOut('fast');
			},
			success : function(ajax_response, statusText, xhr, $form) {
				var response = $.parseJSON(ajax_response);
				loginAjaxLoader.fadeOut('fast');
				loginButton.removeAttr('disabled');
				if (response.success) {
					loginMessage.html(response.message).fadeIn('fast');
					document.location.href = response.redirect;
				}
				else {
					loginError.html(response.message).fadeIn('fast');

					// call reset function if it exists
					if (typeof inspiryResetReCAPTCHA == 'function') {
						inspiryResetReCAPTCHA();
					}
				}
			}
		};

		$('#login-form').validate({
			submitHandler : function(form) {
				$(form).ajaxSubmit(loginOptions);
			}
		});

		/*-----------------------------------------------------------------------------------*/
		/*	AJAX Register Form
		 /*----------------------------------------------------------------------------------*/

		var registerButton = $('#register-button'),
			registerAjaxLoader = $('#register-loader'),
			registerError = $("#register-error"),
			registerMessage = $('#register-message');

		var registerOptions = {
			beforeSubmit : function() {
				registerButton.attr('disabled', 'disabled');
				registerAjaxLoader.fadeIn('fast');
				registerMessage.fadeOut('fast');
				registerError.fadeOut('fast');
			},
			success : function(ajax_response, statusText, xhr, $form) {
				var response = $.parseJSON(ajax_response);
				registerAjaxLoader.fadeOut('fast');
				registerButton.removeAttr('disabled');
				if (response.success) {
					registerMessage.html(response.message).fadeIn('fast');
					$form.resetForm();
				}
				else {
					registerError.html(response.message).fadeIn('fast');

					// call reset function if it exists
					if (typeof inspiryResetReCAPTCHA == 'function') {
						inspiryResetReCAPTCHA();
					}
				}
			}
		};

		$('#register-form').validate({
			rules : {
				register_username : {
					required : true
				},
				register_email : {
					required : true,
					email : true
				}
			},
			submitHandler : function(form) {
				$(form).ajaxSubmit(registerOptions);
			}
		});

		/*-----------------------------------------------------------------------------------*/
		/*	Forgot Password Form
		 /*----------------------------------------------------------------------------------*/

		var forgotButton = $('#forgot-button'),
			forgotAjaxLoader = $('#forgot-loader'),
			forgotError = $("#forgot-error"),
			forgotMessage = $('#forgot-message');

		var forgotOptions = {
			beforeSubmit : function() {
				forgotButton.attr('disabled', 'disabled');
				forgotAjaxLoader.fadeIn('fast');
				forgotMessage.fadeOut('fast');
				forgotError.fadeOut('fast');
			},
			success : function(ajax_response, statusText, xhr, $form) {
				var response = $.parseJSON(ajax_response);
				forgotAjaxLoader.fadeOut('fast');
				forgotButton.removeAttr('disabled');
				if (response.success) {
					forgotMessage.html(response.message).fadeIn('fast');
					$form.resetForm();
				}
				else {
					forgotError.html(response.message).fadeIn('fast');

					// call reset function if it exists
					if (typeof inspiryResetReCAPTCHA == 'function') {
						inspiryResetReCAPTCHA();
					}
				}
			}
		};

		$('#forgot-form').validate({
			submitHandler : function(form) {
				$(form).ajaxSubmit(forgotOptions);
			}
		});

	}

})(jQuery);
