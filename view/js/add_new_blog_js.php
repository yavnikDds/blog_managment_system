<script>
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
    var actively_edited_element = "";
    var actively_edited_element_id = "";

    // id logic
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

    // adding new heading element
    $(document).on("click", "#heading_element", function() {
        actively_edited_element = "heading_element";
        if (is_element_active == false) {
            let element = "heading_element_";
            let id = create_new_id(element);
            let html_code = `
            <div class="preview_element_div current_element_to_edit" id="${id}">
                        <div class="heading_element_preview d-flex flex-wrap align-items-center justify-content-start preview_element" style=" overflow-wrap: break-word; text-align: left;" >
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
        } else {
            alert("Other element is active");
        }
    });
    // adding new heading element
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
                                <input type="text" class="col-12 " style="width: 90%;" id="edit_heading_input" name="edit_heading_input" value="${text}"></input>
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

                    </div>`;
            $("#edit_elements").append(edit_elements_html);
        }
    };
    // /adding corrosponding editing element


    // save action
    $(document).on("click", "#save_btn", function() {
        let element = ($(this).closest('.preview_element_div').children('.preview_element').prop('outerHTML'));
        // save element to the database
        $('#edit_heading_setting').remove();
        $(this).parent().remove();
        $(".preview_element_div").removeClass("current_element_to_edit");
        is_element_active = false;
    });

    // cancel action
    $(document).on("click", "#cancel_btn", function() {
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
    // editing_Value in edit element
    if (actively_edited_element = "heading_element") {

        $(document).on("keyup", "#edit_heading_input", function() {
            let val = $(this).val();
            let h = $("#hading_tags_input_id").val();
            let color = $("#heading_color_input_id").val();
            let tag = `<${h} style="color : ${color}; word-break: break-word" class="text-wrap text-center">`;
            let end_tag = `<${h}>`;
            val = tag + val + end_tag;
            $(".current_element_to_edit").children(".preview_element").html(val);
            // console.log($(this).val());
        });
    }
    // }
    // /editing_Value in edit element
    // start editing new element
    $(document).on("click", ".preview_element", function() {
        alert(actively_edited_element);
        if (is_element_active == false) {
            $(this).parent().addClass("current_element_to_edit");
            let active_buttons = `
            <div class="row d-flex justify-content-end">
            <button type="button" class="btn btn-success col-2 mx-2" id="save_btn">Save</button>
            <button type="button" class="btn btn-primary col-2" mx-2 id="cancel_btn">Cancel</button>
            <button type="button" class="btn btn-light col-2" mx-2 id="delete_btn">Delete</button>
            </div>
            `;
            $(this).parent().append(active_buttons);
            is_element_active = true;
            let text = $(this).children("h1").text();
            let id = $(this).parent().attr("id");
            edit_heading_element(text, actively_edited_element, id)
        } else {
            alert("Other element is active");
        }
    });
</script>