function searchMovie() {

    $('#movielist').html('');

    $.ajax({
        type: 'GET',
        url: 'http://omdbapi.com',
        dataType: 'json',
        data: {
            'apikey': 'f87197e9',
            's': $('#searchinp').val()
        },
        success: function (result) {
            if (result.Response == 'True') {
                let movies = result.Search;

                $.each(movies, function (i, data) {
                    $('#movielist').append(`
                        <div class="col-md-4">
                            <div class="card mb-3">
                                <img class="card-img-top" src="`+ data.Poster + `">
                                <div class="card-body">
                                    <h5 class="card-title">`+ data.Title + `</h5>
                                    <h6 class="card-subtitle mb-2 text-muted">`+ data.Year + `</h6>
                                    <a href="#" class="btn btn-primary seedetails" data-toggle="modal" data-target="#exampleModal" data-id="`+ data.imdbID + `">Details</a>
                                </div>
                            </div>
                        </div>
                    `);
                });

                $('#searchinp').val('');

            } else {
                $('#movielist').html(`
                    <div class="col">
                        <h1 class="text-center">`+ result.Error + `</h1>
                    </div>
                `);
            }
        }
    });

}

$('#searchbutt').on('click', function () {
    searchMovie();
});

$('#searchinp').on('keyup', function (e) {
    if (e.keyCode == 13) {
        searchMovie();
    }
})

$('#movielist').on('click', '.seedetails', function () {
    $.ajax({
        type: 'GET',
        url: 'http://omdbapi.com',
        dataType: 'json',
        data: {
            'apikey': 'f87197e9',
            'i': $(this).data('id')
        },
        success: function (movies) {
            if (movies.Response == 'True') {
                $.each(movies, function (i, data) {
                    $('.modal-body').html(`
                        <div class="container-fluid">
                            <div class="row">
                                <div class="col-md-4">
                                    <img src="`+ movies.Poster + `" class="img-fluid">
                                </div>

                                <div class="col-md-8">
                                    <ul class="list-group">
                                        <li class="list-group-item"><h3>`+ movies.Title + `</h3></li>
                                        <li class="list-group-item">Released : `+ movies.Released + `</li>
                                        <li class="list-group-item">Synopsis : `+ movies.Plot + `</li>
                                        <li class="list-group-item">Writer : `+ movies.Writer + `</li>
                                        <li class="list-group-item">Actor : `+ movies.Actors + `</li>
                                        <li class="list-group-item">Director : `+ movies.Director + `</li>
                                    </ul>
                                </div>
                            </div>
                        </div>
                    `);
                });
            }
        }
    });
});