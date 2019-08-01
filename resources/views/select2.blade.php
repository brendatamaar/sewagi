<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="{{ mix('/css/sewagi.css') }}">
    <title>Document</title>
    <style>
        .select2-container--open .select2-selection {
            box-shadow: none!important;
        }

        .select2-container--open .select2-selection .select2-selection__arrow {
            z-index: 9999; /* example */
        }

        .select2-dropdown {
        /* .box-shadow(@form-control-focus-box-shadow); (from select2-boostrap */
        -webkit-box-shadow: inset 0 1px 1px rgba(0, 0, 0, 0.075), 0 0 8px rgba(102, 175, 233, 0.6);
        box-shadow: inset 0 1px 1px rgba(0, 0, 0, 0.075), 0 0 8px rgba(102, 175, 233, 0.6);
        
        /* border-color: @input-border-focus; */
        border-color: #66afe9;
        border-top-width: 1px!important;
        border-top-style: solid!important;
        /* border-top-left-radius: @input-border-radius; */
        border-top-left-radius: 4px!important;
        /* border-top-right-radius: @input-border-radius; */
        border-top-right-radius: 4px!important;
        
        /* margin-top: -@input-height-base; */
        margin-top: -34px!important;
        }

        .select2-dropdown .select2-search {
            padding: 0;
        }

        .select2-dropdown .select2-search .select2-search__field {
        
            /* !important not needed using less */
            /* border-top: 0!important;
            border-left: 0!important;
            border-right: 0!important;
            border-radius: 0!important; */
            
            /* padding: @padding-base-vertical @padding-base-horizontal; */
            /* padding: 6px 12px; */
            
            /* height: calc(@input-height-base - 1px); */
            /* height: 100%; */
        }

        .select2-dropdown.select2-dropdown--above {
            /* border-bottom: 1px solid @input-border-focus; */
            border-bottom: 1px solid #66afe9!important;
            /* border-bottom-left-radius: @input-border-radius; */
            border-bottom-left-radius: 4px!important;
            /* border-bottom-right-radius: @input-border-radius; */
            border-bottom-right-radius: 4px!important;
            /* margin-top: @input-height-base; */
            margin-top: 34px!important;
            }

        .select2-dropdown.select2-dropdown--above .select2-search .select2-search__field {
        /* border-top: 1px solid @input-border; */
        border-top: 1px solid #66afe9!important;
        border-bottom: 0!important;
        }
    </style>
</head>
<body>
    <div class="container">
        <form>
            <div class="form-group">
                <label for="exampleInputEmail1">Email address</label>
                <input type="email" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" placeholder="Enter email">
                <small id="emailHelp" class="form-text text-muted">We'll never share your email with anyone else.</small>
            </div>
            <div class="form-group">
                <label for="exampleInputPassword1">Password</label>
                <input type="password" class="form-control" id="exampleInputPassword1" placeholder="Password">
            </div>
            <div class="form-group">
                <label for="">Select</label>
                <select class="form-control" id="select2-single-box" name="select2-single-box" data-placeholder="Pick your choice" data-tabindex="2">
                    <option></option>
                    <option value="1">First choice</option>
                    <option value="2">Second choice</option>
                    <option value="3">Third choice</option>
                    <option value="4">Fourth choice</option>
                    <option value="5">Fifth choice</option>
                    <option value="6">Sixth choice</option>
                    <option value="7">Seventh choice</option>
                    <option value="8">Eighth choice</option>
                    <option value="9">Ninth choice</option>
                </select>
            </div>
            <div class="form-check">
                <input type="checkbox" class="form-check-input" id="exampleCheck1">
                <label class="form-check-label" for="exampleCheck1">Check me out</label>
            </div>
            <button type="submit" class="btn btn-primary">Submit</button>
        </form>
    </div>
    <script type="text/javascript" src="{{ mix('js/sewagi.js') }}"></script>
    <link href="https://select2.github.io/select2-bootstrap-theme/css/select2-bootstrap.css" rel="stylesheet"/>
    <script>
        var elements = $(document).find('select.form-control');
            for (var i = 0, l = elements.length; i < l; i++) {
            var $select = $(elements[i]);
            $label = $select.parents('.form-group').find('label');
            console.log($label.html());
            
            $select.select2({
                allowClear: true,
                placeholder: $select.data('placeholder'),
                minimumResultsForSearch: 0,
                theme: 'bootstrap',
                width: '100%'
            });
            
            // Trigger focus
            // $label.on('click', function (e) {
            //     $(this).parents('.form-group').find('select').trigger('focus').select2('focus');
            // });
            
            // Trigger search
            // $select.on('keydown', function (e) {
            //     var $select = $(this), $select2 = $select.data('select2'), $container = $select2.$container;
                
            //     // Unprintable keys
            //     if (typeof e.which === 'undefined' || $.inArray(e.which, [0, 8, 9, 12, 16, 17, 18, 19, 20, 27, 33, 34, 35, 36, 37, 38, 39, 44, 45, 46, 91, 92, 93, 112, 113, 114, 115, 116, 117, 118, 119, 120, 121, 123, 124, 144, 145, 224, 225, 57392, 63289]) >= 0) {
            //     return true;
            //     }

            //     // Already opened
            //     if ($container.hasClass('select2-container--open')) {
            //     return true;
            //     }

            //     $select.select2('open');

            //     // Default search value
            //     var $search = $select2.dropdown.$search || $select2.selection.$search, query = $.inArray(e.which, [13, 40, 108]) < 0 ? String.fromCharCode(e.which) : '';
            //     if (query !== '') {
            //     $search.val(query).trigger('keyup');
            //     }
            // });

            // Format, placeholder
            $select.on('select2:open', function (e) {
                var $select = $(this), $select2 = $select.data('select2'), $dropdown = $select2.dropdown.$dropdown || $select2.selection.$dropdown, $search = $select2.dropdown.$search || $select2.selection.$search, data = $select.select2('data');
                
                // Above dropdown
                if ($dropdown.hasClass('select2-dropdown--above')) {
                $dropdown.append($search.parents('.select2-search--dropdown').detach());
                }

                // Placeholder
                $search.attr('placeholder', (data[0].text !== '' ? data[0].text : $select.data('placeholder')));
            });
        }
    </script>
</body>
</html>