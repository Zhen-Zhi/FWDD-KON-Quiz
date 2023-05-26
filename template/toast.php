<div class="toast align-items-center border-0 position-fixed top-30 start-50 translate-middle-x" id="liveToast" role="alert" aria-live="assertive" aria-atomic="true">
  <div class="d-flex">
    <div class="toast-body">
        
    </div>
    <button type="button" class="btn-close btn-close-white me-2 m-auto" data-bs-dismiss="toast" aria-label="Close"></button>
  </div>
</div>

<script>
  const toastLiveExample = document.getElementById('liveToast')
  const toastBootstrap = bootstrap.Toast.getOrCreateInstance(toastLiveExample)
  
  $(document).ready(function() {
        var message = decodeURIComponent(getUrlParameter('message'));
        var error = decodeURIComponent(getUrlParameter('error'));
        if (message) {
            $('#liveToast').addClass('text-bg-success');
            $('#liveToast').find('.toast-body').html(message);
            toastBootstrap.show();

            const newUrl = window.location.href.replace(`&message=${message}`, '');
            history.replaceState(null, null, newUrl);
        }
        if(error){
            $('#liveToast').addClass('text-bg-danger');
            $('#liveToast').find('.toast-body').html(message);
            toastBootstrap.show();

            const newUrl = window.location.href.replace(`&message=${message}`, '');
            history.replaceState(null, null, newUrl);
        }
    });

    function getUrlParameter(name) {
        name = name.replace(/[\[]/, '\\[').replace(/[\]]/, '\\]');
        var regex = new RegExp('[\\?&]' + name + '=([^&#]*)');
        var results = regex.exec(location.search);
        return results === null ? '' : decodeURIComponent(results[1].replace(/\+/g, ' '));
    };
</script>

<style>
  #liveToast{
    z-index: 9999;
  }
</style>

