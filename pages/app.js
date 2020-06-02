$(document).ready(function () {
    $('.idConta').click(function(e){
        $('#AlterarConta').modal('show');
        
            var id = $(e.target).closest('tr').find("#idConta").html();
            document.getElementById('idContaUp').value = id;
        return false;
    })
});