<div id="kt_tree_1" class="tree-demo">
    <ul>
        @for ($i=0;$i<count($data);$i++)
        <li data-jstree='{ "type" : "file-red" }'>
            Data {{$i}}
            <ul>
                @foreach ($data[$i] as $key => $item)
                <li data-jstree='{ "opened" : true }'>
                    {{$key}}
                    <ul>
                        <li data-jstree='{ "type" : "api" }'>
                            {{$item}}
                        </li>

                    </ul>
                </li>
                @endforeach

            </ul>
        </li>
        @endfor
    </ul>
</div>
<script>
$("#kt_tree_1").jstree({
    "core": {
        "themes": {
            "responsive": false
        }
    },
    "types": {
        "default": {
            "icon": "fa fa-folder text-warning"
        },
        "api": {
            "icon": "fab fa-ethereum text-success "
        },
        "file-red": {
            "icon": "fas fa-wave-square text-danger "
        }
    },
    "plugins": ["types"]
});
</script>
