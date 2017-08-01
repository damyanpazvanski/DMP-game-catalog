$(function () {
    var game = {};
    $('#removeGame').on('click', function (event) {
        var gameId = $(event.target).attr('data-id');
        game = new Game(gameId);
    });

    $('#removeGameAccept').on('click', function () {
        $.ajax({
            url: '/delete-game',
            method: 'POST',
            data: {
                gameId: game.getId()
            },
            dataType: 'json',
            success: function (response) {
                if (response['error'] == false) {
                    window.location = '/games';
                }
            }
        });
    });

    var Game = (function () {
        function constructor(id) {
            this.id = id;
        }

        constructor.prototype.setId = function (id) {
            this.id = id;
        };

        constructor.prototype.getId = function () {
            return this.id;
        };

        return constructor;
    })();
});