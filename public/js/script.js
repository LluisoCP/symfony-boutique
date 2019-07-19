$(document).ready(function() {
    $('.delete-order').on('click', function() {
        // alert('Ya estas tardando en borrar ' + this.id.substr(1) + '!!')
        let id = this.id.substr(1);

        $.ajax({
            url: 'supprimePanier',
            method: 'POST',
            data: {id:id},
            error: function(err) {
                console.log('Error: ' + err.message + ', Code: ' + err.code)
            },
            success: function(data) {
                // alert(data);
                window.location.reload();
            }
        });
    });
    $('.edit-order').on('click', function() {
        let id = this.id.substr(1);
        let quantite = $('#q'+id).val();
        // alert(quantite);
        $.ajax({
            url: 'modifiePanier',
            method: 'POST',
            data: {id:id, q: quantite,},
            error: function(err) {
                console.log('Error:' + err.message, 'Code: ' + err.code);
            },
            success: function(data){
                alert(data);
                window.location.reload();
            }
        });
    });
})