((Joomla, window, document) => {

  if (!Joomla) {
    throw new Error('core.js was not properly initialised');
  } // Handle the autocomplete

  resetLicense = ({
                    target
                  }) => {
    const where = document.getElementById('where');
    const license = document.getElementById('license');
    const ResetSuccess = document.getElementById('ResetSuccess');
    const ResetError = document.getElementById('ResetError');
    const url = target.getAttribute('data-url');

    if (where.value.length >= 1 && license.value.length >= 1) {
      Joomla.request({
        url: `${url}&license=${license.value}&where=${where.value}`,
        method: 'GET',
        onSuccess: resp => {
          ResetError.classList.add('hidden');
          ResetSuccess.classList.remove('hidden');
        },
        onError: xhr => {
          ResetSuccess.classList.add('hidden');
          ResetError.classList.remove('hidden');
          if (xhr.status > 0) {
            Joomla.renderMessages(Joomla.ajaxErrorsMessages(xhr));
          }
        }
      });
    }
  };


  const onBoot = () => {
    const resetButton = document.getElementById('sportsmanagerresetlicense');
    resetButton.addEventListener('click', resetLicense);

    document.removeEventListener('DOMContentLoaded', onBoot);
  };

  document.addEventListener('DOMContentLoaded', onBoot);
})(window.Joomla, window, document);
