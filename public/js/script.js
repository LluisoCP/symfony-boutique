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
                alert(data);
            }
        })
    });
})