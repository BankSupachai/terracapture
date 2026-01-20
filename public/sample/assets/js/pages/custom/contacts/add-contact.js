"use strict";

// Class definition
var KTContactsAdd = function () {
	// Base elements
	var _wizardEl;
	var _formEl;
	var _wizard;
	var _avatar;
	var _validations = [];

	var initWizard = function () {
		_wizard = new KTWizard(_wizardEl, {
			startStep: 1,
			clickableSteps: true
		});

		_wizard.on('beforeNext', function (wizard) {
			_wizard.stop();
			var validator = _validations[wizard.getStep() - 1];
			validator.validate().then(function (status) {
				if (status == 'Valid') {
					_wizard.goNext();
					KTUtil.scrollTop();
				} else {
					Swal.fire({
						text: "Sorry, looks like there are some errors detected, please try again.",
						icon: "error",
						buttonsStyling: false,
						confirmButtonText: "Ok, got it!",
						customClass: {
							confirmButton: "btn font-weight-bold btn-light"
						}
					}).then(function () {
						KTUtil.scrollTop();
					});
				}
			});
		});

		_wizard.on('change', function (wizard) {
			KTUtil.scrollTop();
		});
	}

	var initValidation = function () {

		// Step 1
		_validations.push(FormValidation.formValidation(
			_formEl,
			{
				plugins: {
					trigger: new FormValidation.plugins.Trigger(),
					bootstrap: new FormValidation.plugins.Bootstrap()
				}
			}
		));

		// Step 2
		_validations.push(FormValidation.formValidation(
			_formEl,
			{
				plugins: {
					trigger: new FormValidation.plugins.Trigger(),
					bootstrap: new FormValidation.plugins.Bootstrap()
				}
			}
		));

		// Step 3
		_validations.push(FormValidation.formValidation(
			_formEl,
			{
				plugins: {
					trigger: new FormValidation.plugins.Trigger(),
					bootstrap: new FormValidation.plugins.Bootstrap()
				}
			}
		));

		// Step 4
        _validations.push(FormValidation.formValidation(
			_formEl,
			{
				plugins: {
					trigger: new FormValidation.plugins.Trigger(),
					bootstrap: new FormValidation.plugins.Bootstrap()
				}
			}
		));

        // Step 5
        _validations.push(FormValidation.formValidation(
            _formEl,
            {
                plugins: {
                    trigger: new FormValidation.plugins.Trigger(),
                    bootstrap: new FormValidation.plugins.Bootstrap()
                }
            }
        ));
	}

	var initAvatar = function () {
		_avatar = new KTImageInput('kt_contact_add_avatar');
	}

	return {
		// public functions
		init: function () {
			_wizardEl = KTUtil.getById('kt_contact_add');
			_formEl = KTUtil.getById('kt_contact_add_form');

			initWizard();
			initValidation();
			initAvatar();
		}
	};
}();

jQuery(document).ready(function () {
	KTContactsAdd.init();
});
