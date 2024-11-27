<script>
    // get token for a page
    // document.ready(function(){
    window.token=null;
    $.ajax({
        url: "<?= URL_CONTROLLER ?>/add_blog.controller.php",
        dataType: "json",
        type: "POST",
        data: {
            task: "get_token_id",
        },
        success: function(data) {
            alert(data["id"]);
            window.token =data["id"]+1;
        }
    });
    // });
    // /get token for a page 
    // confirmation to go to home page
    $(document).on("click", "#home_page", function(e) {
        e.preventDefault();
        if (confirm('Do you want to go back.')) {
            if (confirm('Do you want to save changes.')) {
                // function to save changes
                // redirect to the home page 
                window.location.href = "index.php";
                alert("The changes have been saved.");
            } else {
                alert("You canceled the request to go back.");
            }
        } else {
            alert("okay");
        }
    });
    // /confirmation to go to home page

    var is_element_active = false;
    var elements_id_array = new Array();
    window.actively_edited_element = "";
    window.actively_edited_element_id = "";

    // id logic
    // ------------------------------------------- section 1 - elements
    // create a new id for element
    function create_new_id(element) {
        let random_number = Math.floor(Math.random() * 10000);
        let new_id = element + random_number;
        if (elements_id_array.includes(new_id)) {
            create_new_id();
        } else {
            elements_id_array.push(new_id);
            return new_id;
        }
    }
    // /create a new id for element
    // adding new heading element to the page 
    $(document).on("click", "#heading_element", function() {
        actively_edited_element = "heading_element";
        if (is_element_active == false) {
            let element = "heading_element_";
            let id = create_new_id(element);
            window.actively_edited_element_id = id;
            console.log("created a new id" + window.actively_edited_element_id);
            let html_code = `
            <div class="preview_element_div current_element_to_edit" id="${id}">
            <div class="heading_element_preview preview_element" style=" overflow-wrap: break-word;" >
            <h1>Title</h1>
            </div>
            </div>
            `;
            $("#page_preview").append(html_code);
            let active_buttons = `
            <div class="row d-flex justify-content-end">
            <button type="button" class="btn btn-success col-2 mx-2" id="save_btn">Save</button>
            <button type="button" class="btn btn-primary col-2" mx-2 id="cancel_btn">Cancel</button>
            <button type="button" class="btn btn-light col-2" mx-2 id="delete_btn">Delete</button>
            </div>
            `;
            $("#page_preview .preview_element_div:last").append(active_buttons);
            is_element_active = true;
            let text = "Title";
            $('#edit_heading_setting').remove();
            edit_heading_element(text, actively_edited_element, id);
            $(".main-input").focus();
        } else {
            alert("Other element is active");
        }
    });
    // /adding new heading element to the page

    // ------------------------------------------- section 2 - page preview
    // start editing new element
    $(document).on("click", ".preview_element", function() {
        if (is_element_active == false) {
            // console.log(is_element_active);
            // alert("is_element_active false");
            $(this).parent().addClass("current_element_to_edit");
            window.actively_edited_element_id = $(".current_element_to_edit").attr("id");
            console.log(window.actively_edited_element_id);
            let active_buttons = `
            <div class="row d-flex justify-content-end">
            <button type="button" class="btn btn-success col-2 mx-2" id="save_btn">Save</button>
            <button type="button" class="btn btn-primary col-2" mx-2 id="cancel_btn">Cancel</button>
            <button type="button" class="btn btn-light col-2" mx-2 id="delete_btn">Delete</button>
            </div>
            `;
            $(this).parent().append(active_buttons);
            let text = $(this).children("h1").text() ? $(this).children("h1").text() : "";
            let id = $(this).parent().attr("id");
            edit_heading_element(text, actively_edited_element, id)
            // console.log(actively_edited_element);
            focus_on_main_input(actively_edited_element);
            is_element_active = true;
        } else if ($(this).hasClass("heading_element_preview")) {
            if ($(this).parent().hasClass("current_element_to_edit")) {
                // alert("this element is currently active");
                $(".main-input").focus();
            } else {
                alert("Other element is active");
            }
        }
    });


    // focus on content input element
    function focus_on_main_input(actively_edited_element) {
        if (actively_edited_element == "heading_element") {
            $(".main-input").focus();
        }
    }

    // $(document).on("click", ".current_element_to_edit", function() {
    //     console.log("active .current_element_to_edit is clicked");
    //     console.log(is_element_active);
    //     if (is_element_active == false && actively_edited_element == "heading_element") {
    //     }
    // });


    // save action
    $(document).on("click", "#save_btn", function() {
        heading_element_values();
        $(".preview_element_div").each(function(i, obj) {
            $(this).attr("data-sr-no", i);
        })
        let sr_no = $(".current_element_to_edit").attr("data-sr-no");
        let element = ($(this).closest('.preview_element_div').children('.preview_element').prop('outerHTML'));
        // save element to the database
        $('#edit_heading_setting').remove();
        $(this).parent().remove();
        is_element_active = false;
        if (actively_edited_element == "heading_element") {
            window.saved_heading_element_value = window.current_heading_element_value;
            window.saved_heading_element_tag = window.current_heading_element_tag;
            window.saved_heading_element_h = window.current_heading_element_h;
            window.saved_heading_element_color = window.current_heading_element_color;
            window.saved_heading_element_text_alignment = window.current_heading_element_text_alignment;
            console.log({
                sr_no: sr_no,
                id: window.actively_edited_element_id,
                task: "save_heading_element",
                element: "heading_element",
                value: window.saved_heading_element_value,
                tag: window.saved_heading_element_tag,
                h: window.saved_heading_element_h,
                color: window.saved_heading_element_color,
                text_alignment: window.saved_heading_element_text_alignment
            });
            // let object = {
            //     "tag": window.saved_heading_element_tag,
            //     "h": window.saved_heading_element_h,
            //     "color": window.saved_heading_element_color,
            //     "text_alignment": window.saved_heading_element_text_alignment
            // };
            $.ajax({
                url: "<?= URL_CONTROLLER ?>/add_blog.controller.php",
                dataType: "json",
                type: "POST",
                data: {
                    task: "save_heading_element",
                    element_name: "heading_element",
                    sr_no: sr_no,
                    element_id: window.actively_edited_element_id,
                    value: window.saved_heading_element_value,
                    tag: window.saved_heading_element_tag,
                    h: window.saved_heading_element_h,
                    color: window.saved_heading_element_color,
                    text_alignment: window.saved_heading_element_text_alignment
                },
                success: function(data) {
                    console.log(data);
                }
            });
            $(".preview_element_div").removeClass("current_element_to_edit");
        };
    });

    // cancel action
    $(document).on("click", "#cancel_btn", function() {
        // alert( window.token);
        // read and populate previously stored data to the element from data base
        $('#edit_heading_setting').remove();
        $(this).parent().remove();
        $(".preview_element_div").removeClass("current_element_to_edit");
        is_element_active = false;
    });
    // delete action
    $(document).on("click", "#delete_btn", function() {
        if (confirm("Do you want to delete this element?")) {
            // read and populate previously stored data to the element from data base
            let id = $(this).parent().parent().attr("id");
            // let msg = "this id is getting deleted :-"+id; 
            elements_id_array = jQuery.grep(elements_id_array, function(value) {
                return value != id;
            });
            $('#edit_heading_setting').remove();
            $(this).parent().parent().remove();
            // $(this).closest(".preview_element_div").removeClass(".current_element_to_edit");
            is_element_active = false;
            alert("The element is delete.")
        } else {
            alert("Okay");
        }
    });
    // ------------------------------------------- section 3 - Edit Element

    // adding corrosponding editing element
    function edit_heading_element(text, actively_edited_element, id) {
        if (actively_edited_element == "heading_element") {
            let edit_elements_html = `
                    <div id="edit_heading_setting" data-active-element-id="${id}">
                        <h4>Edit Heading</h4>
                        <div class="row">
                            <div class="col">Content</div>
                            <div class="col">style</div>
                            <div class="col">Advance</div>
                        </div>
                        <div class="row ms-2">
                            <h6>title</h6>
                                <input type="text" class="col-12 main-input" style="width: 90%;" id="edit_heading_input" name="edit_heading_input" value="${text}"></input>
                        </div>
                        <div class="row w-25 ms-2">
                            <label for="hading_tags">Choose Tag</label>
                            <select name="hading_tags" id="hading_tags_input_id">
                              <option value="h1">h1</option>
                              <option value="h2">h2</option>
                              <option value="h3">h3</option>
                              <option value="h4">h4</option>
                              <option value="h5">h5</option>
                              <option value="h6">h6</option>
                            </select>
                        </div>
                        <div class="row w-25 ms-2">
                            <label for="heading_color_input_id">Select color:</label>
                            <input type="color" id="heading_color_input_id" name="heading_color_input_id" value="#000000">
                        </div>
                        <div class="row w-50 ms-2 d-flex justify-content-around">
                            <label for="heading_text_alignment_id">Text Alignment:</label>
                            <button class="text_alignment_btn bg-light btn col-2 p-1 m-0 active" data-value="left"><i class="fa-solid fa-align-left"></i></button>
                            <button class="text_alignment_btn bg-light btn col-2 p-1 m-0" data-value="right"><i class="fa-solid fa-align-right"></i></button>
                            <button class="text_alignment_btn bg-light btn col-2 p-1 m-0" data-value="center"><i class="fa-solid fa-align-justify"></i></button>
                        </div>
                    </div>`;
            $("#edit_elements").append(edit_elements_html);
        }
    };
    // its custom fetures
    // text-align features
    $(document).on("click", ".text_alignment_btn", function() {
        $(".text_alignment_btn").removeClass("active");
        $(this).addClass("active");
    });
    // /adding corrosponding editing element
    // editing_Value in edit element
    window.current_heading_element_h;
    window.current_heading_element_color;
    window.current_heading_element_text_alignment;
    window.current_heading_element_tag;
    window.current_heading_element_value;

    function heading_element_values() {
        window.current_heading_element_value = $("#edit_heading_input").val();
        window.current_heading_element_h = $("#hading_tags_input_id").val();
        window.current_heading_element_color = $("#heading_color_input_id").val();
        window.current_heading_element_text_alignment = $(".text_alignment_btn.active").attr("data-value");
        window.current_heading_element_tag = `<${window.current_heading_element_h} style="color : ${window.current_heading_element_color}; word-break: break-word ; text-align:${window.current_heading_element_text_alignment};" class="text-wrap">${window.current_heading_element_value}<${window.current_heading_element_h}>`;
        // let end_tag = `<${h}>`;
        // if($(".text_alignment_btn").hasClass("active")){
        //     console.log(".text_alignment_btn");
        //     console.log();
        // alert(window.current_heading_element_text_alignment);
        // }
        // val = window.current_heading_element_tag + val + end_tag;
        $(".current_element_to_edit").children(".preview_element").html(window.current_heading_element_tag);
        // $(".current_element_to_edit").children(".preview_element").removeClass("left");
        // $(".current_element_to_edit").children(".preview_element").removeClass("right");
        // $(".current_element_to_edit").children(".preview_element").removeClass("center");
        // $(".current_element_to_edit").children(".preview_element").addClass(`${window.current_heading_element_text_alignment}`);
    }
    if (actively_edited_element = "heading_element") {
        $(document).on("keyup", "#edit_heading_input", function() {
            heading_element_values();
        });
        $(document).on("change", "#hading_tags_input_id", function() {
            heading_element_values();
        });
        $(document).on("change", "#heading_color_input_id", function() {
            heading_element_values();
        });
        $(document).on("click", ".text_alignment_btn", function() {
            heading_element_values();
        });
    }
    // }
    // /editing_Value in edit element
</script>