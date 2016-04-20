/**
 * Created by Julien on 20-04-16.
 */


function readURL(input) {
    if (input.files && input.files[0]) {
        var reader = new FileReader();
        var width;
        var height = 200;

        reader.onload = function (e) {
            var img = new Image;

            img.onload = function() {
                if (img.width > img.height) {
                    width = 300;
                } else {
                    width = 175;
                }
            };

            img.src = reader.result;

            $('#show')
                .attr('src', e.target.result)
                .width(width)
                .height(height)
                .show();
        };

        reader.readAsDataURL(input.files[0]);
    }
}