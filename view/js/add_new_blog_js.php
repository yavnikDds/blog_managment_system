<script>
    // plugins

    // confirmation before reload
    window.onbeforeunload = function() {
        return "Message here";
    }
    // $(window).bind('beforeunload', function() {
    //     return '>>>>>Before You Go<<<<<<<< \n Your custom message go here';
    // });
    // window.onbeforeunload = function(event) {
    //     alert("fdsjfdslkj");
    //     return confirm("do you really want to reload this page ?");
    // };
    // function counter() {
    //     return window.result;
    // }
    // functions
    window.result = 0;

    function generate_new_slug(Text, result) {
        if (result == "first") {
            Text = Text;
        } else {
            window.result += 1;
            Text = Text + "-" + window.result;
        }
        return Text.toLowerCase().replace(/ /g, "-").replace(/[^\w-]+/g, "");
    }

    // /functions
    // generate token for a page
    // document.ready(function(){
    window.token = null;
    $.ajax({
        url: "<?= URL_CONTROLLER ?>/add_blog.controller.php",
        dataType: "json",
        type: "POST",
        data: {
            task: "get_token_id",
        },
        success: function(data) {
            window.token = data["id"] + 1;
            // alert(window.token);
        }
    });
    // /generate token for a page 
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
    window.token = window.token;
    window.slug = "";
    window.slug_for_token = "";
    window.title = "";

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
            <button type="button" class="btn btn-success col-2 mx-2" id="save_btn_1">Save</button>
            <button type="button" class="btn btn-light col-2" mx-2 id="delete_btn_1">Delete</button>
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


    // adding new texteditor 
    $(document).on("click", "#text_editor_element", function() {
        // element name
        actively_edited_element = "text_editor_element";
        // check if other element is edited
        if (is_element_active == false) {
            // create id
            let element = "text_editor_element_";
            let id = create_new_id(element);
            window.actively_edited_element_id = id;
            window.texteditor_id = id;
            // element html code
            let html_code = `
            <div class="preview_element_div current_element_to_edit" id="${id}">
            <div class="text_editor_element preview_element" style="" >
            <textarea class="editor" rows="3" name="${id}""></textarea>
            </div>
            </div>
            `;
            // append element for editing on section 3
            $("#edit_elements").append(html_code);
            $(`#${window.texteditor_id}`).Editor();


            // append the clone of text editor in preview page
            let html_code_clone = `
            <div class="preview_element_div current_element_to_edit" data_id="${id}">
            <div class="text_editor_element preview_element" style=" overflow-wrap: break-word;" >
            <div class="${id}"></div>
            </div>
            </div>
            `;
            // appending 
            $("#page_preview").append(html_code_clone);

            // button code
            let active_buttons = `
            <div class="row d-flex justify-content-end">
            <button type="button" class="btn btn-success col-2 mx-2" id="save_btn_1">Save</button>
            <button type="button" class="btn btn-light col-2" mx-2 id="delete_btn_1">Delete</button>
            </div>
            `;
            // let texteditor_setting_code = ($('#page_preview').children('.Editor-container').children(`#menuBarDiv_${window.texteditor_id}`).prop('outerHTML'));
            // $('#page_preview').children('.Editor-container').children(`#menuBarDiv_${window.texteditor_id}`).remove();

            // $("#page_preview .preview_element_div:last").append(active_buttons);
            $("#page_preview .preview_element_div:last").append(active_buttons);

            console.log("4");
            is_element_active = true;
            let text = "Write your paragraph";
            $('#edit_heading_setting').remove();
            // edit_texteditor_setting(text, actively_edited_element, id, texteditor_setting_code);
            console.log("4");
            $(".Editor-editor").attr("tabindex", "0");
            $(`#menuBarDiv_${window.actively_edited_element_id}`).attr("tabindex", "0");
            // $(".main-input").focus();
        } else {
            alert("Other element is active");
        }
    });
    $(document).on("keyup", ".Editor-editor", function() {
        if (actively_edited_element == "text_editor_element") {
            let val = $(this).html();
            $(`.${window.actively_edited_element_id}`).html(val);
        }
    });

    // needs to resolve later
    // console.log("1");
    // $(document).on("click", `#menuBarDiv_${window.actively_edited_element_id}`, function() {
    //     alert("click");
    //     let val = $(this).parent().children(".Editor-editor").html();
    //     $(`.${window.actively_edited_element_id}`).html(val);
    // });
    // console.log("2");


    // /adding new texteditor


    // adding a new image
    $(document).on("click", "#image_element", function() {
        actively_edited_element = "image_element";
        if (is_element_active == false) {
            let element = "image_element_";
            let id = create_new_id(element);
            window.actively_edited_element_id = id;
            console.log("created a new id " + window.actively_edited_element_id);
            let html_code = `
            <div class="preview_element_div current_element_to_edit" id="${id}">
            <div class="image_element preview_element" style="" >
            <img src="http://localhost/yavnik/_code/blog_managment_system/images/blank.png" alt="blank" width="500">
            </div>
            </div>
            `;
            $("#page_preview").append(html_code);
            let active_buttons = `
            <div class="row d-flex justify-content-end">
            <button type="button" class="btn btn-success col-2 mx-2" id="save_btn_1">Save</button>
            <button type="button" class="btn btn-light col-2" mx-2 id="delete_btn_1">Delete</button>
            </div>
            `;
            $("#page_preview .preview_element_div:last").append(active_buttons);
            is_element_active = true;
            $('#edit_heading_setting').remove();
            edit_image_element(actively_edited_element, id);
            // $(".image-uploader").hover(function() {
            //     src = $(".uploaded-image").children("img").attr("src") ? $(".uploaded-image").children("img").attr("src") : "http://localhost/yavnik/_code/blog_managment_system/images/blank.png";
            //     $(`#${id}`).children(".image_element").children("img").attr("src", `${src}`);
            // }, function() {});
            window.count = 1;
        } else {
            alert("Other element is active");
        }
    });
    // /adding a new image

    // adding a new video
    $(document).on("click", "#video_element", function() {
        console.log("video_element");
        window.actively_edited_element = "video_element";
        if (is_element_active == false) {
            let element = "video_element_";
            let id = create_new_id(element);
            window.actively_edited_element_id = id;
            // console.log("created a new id " + window.actively_edited_element_id);
            let html_code = `
            <div class="preview_element_div current_element_to_edit" id="${id}">
            <div class="video_element preview_element" style="" >
            <iframe width="420" height="345" src="https://www.youtube.com/embed/1UyQaR8pvjk?si=atiJv2ZxVozHH2S5"></iframe>
            </div>
            </div>
            `;
            $("#page_preview").append(html_code);
            let active_buttons = `
            <div class="row d-flex justify-content-end">
            <button type="button" class="btn btn-success col-2 mx-2" id="save_btn_1">Save</button>
            <button type="button" class="btn btn-light col-2" mx-2 id="delete_btn_1">Delete</button>
            </div>
            `;
            $("#page_preview .preview_element_div:last").append(active_buttons);
            is_element_active = true;
            $('#edit_heading_setting').remove();
            edit_video_element(actively_edited_element, id);
        } else {
            alert("Other element is active");
        }
    });
    // /adding a new video

    // ------------------------------------------- section 2 - page preview
    // click on already inserted on element to edit
    $(document).on("click", ".preview_element", function() {

        if (is_element_active == false) {
            is_element_active = true;
            $('#edit_heading_setting').remove();
            // add class
            $(this).parent().addClass("current_element_to_edit");
            // get element id
            // buttons html
            let active_buttons = `
            <div class="row d-flex justify-content-end">
            <button type="button" class="btn btn-success col-2 mx-2" id="save_btn_1">Save</button>
            <button type="button" class="btn btn-light col-2" mx-2 id="delete_btn_1">Delete</button>
            </div>
            `;
            // append html button code
            $(this).parent().append(active_buttons);
            // if element is text_editor_element
            if ($(this).hasClass("text_editor_element")) {
                actively_edited_element = "text_editor_element";
                window.actively_edited_element_id = $(".current_element_to_edit").children().children().attr("class");

                let value = $(`.${window.actively_edited_element_id}`).html();
                // alert("text_editor_element");
                // get id stored as class name 
                let id = $(this).children().attr("class");
                let html_code = `
            <div class="preview_element_div current_element_to_edit" id="${id}">
            <div class="text_editor_element preview_element" style="" >
            <textarea class="editor" rows="3" name="${id}""></textarea>
            </div>
            </div>
            `;
                // append element for editing on section 3
                $("#edit_elements").append(html_code);
                // get id of a clicked element
                window.texteditor_id = $(this).children().attr("class");
                // apply jquery
                $(`#${window.texteditor_id}`).Editor();
                // make them like input elements
                $(".Editor-editor").attr("tabindex", "0");
                $(`#menuBarDiv_${window.actively_edited_element_id}`).attr("tabindex", "0");
                // insert previously added value in it 
                $(".Editor-editor").html(value);

            }
            if ($(this).hasClass("heading_element_preview")) {
                console.log("heading_element_preview");
                actively_edited_element = "heading_element";
                // alert(window.actively_edited_element_id);
                let text = $(this).children("h1").text() ? $(this).children("h1").text() : "";
                let id = $(this).parent().attr("id");
                edit_heading_element(text, actively_edited_element, id)
                focus_on_main_input(actively_edited_element);
            }
            if ($(this).hasClass("image_element")) {
                actively_edited_element = "image_element";
                let img_id = $(this).parent().attr("id");
                // $('#edit_heading_setting').remove();
                edit_image_element("image_element", img_id);
                window.actively_edited_element_id = img_id;
                console.log("clicked " + window.actively_edited_element_id);
            }
            if ($(this).hasClass("video_element")) {
                let vid_id = $(this).parent().attr("id");
                actively_edited_element = "video_element";
                window.actively_edited_element_id = vid_id;
                // $('#edit_heading_setting').remove();
                edit_video_element("video_element", vid_id);
                console.log("clicked " + window.actively_edited_element_id);
            }

        } else {
            alert("Other element is active");
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


    // -------------------------------------------------------- save action

    // to save whole page 
    $(document).on("click", "#save_btn", function() {
        let i = 0;
        let page_elements = [];
        let title = null;
        $(".preview_element_div").each(function(i) {
            console.log(++i);
            $(this).attr("data-sr-no", i);
            // let element_name=$(this).children().hasClass(".heading_element_preview");
            if ($(this).children().hasClass("heading_element_preview")) {
                // console.log("heading_element_preview_ triggerd");
                // console.log($(this).children().html());
                let heading_element = $(this).children().html();
                let id = $(this).attr("id");
                if (title === null) {
                    // console.log("title is null");
                    title = $(this).children().children().text();
                    // console.log(title);
                }
                page_elements[i - 1] = {
                    "index": i - 1,
                    "element": "heading_element",
                    "data": heading_element,
                    "id": id
                };
            } else if ($(this).children().hasClass("text_editor_element")) {
                let text_element = $(this).children().children().html();
                // let id = $(this).children().children().html();
                let id = $(this).attr("data_id");
                page_elements[i - 1] = {
                    "index": i - 1,
                    "element": "text_editor_element",
                    "data": text_element,
                    "id": id
                };
            } else if ($(this).children().hasClass("image_element")) {
                let image_element = $(this).children().html();
                let id = $(this).attr("id");
                page_elements[i - 1] = {
                    "index": i - 1,
                    "element": "image_element",
                    "data": image_element,
                    "id": id
                };
            } else if ($(this).children().hasClass("video_element")) {
                let video_element = $(this).children().html();
                let id = $(this).attr("id");
                page_elements[i - 1] = {
                    "index": i - 1,
                    "element": "video_element",
                    "data": video_element,
                    "id": id
                };
            }
        });
        if (window.slug == "") {
            window.slug = generate_new_slug(title, "first");
        } else {
            window.slug = generate_new_slug(title, "not_first");
        }
        console.log(window.slug);
        $.ajax({
            url: "<?= URL_CONTROLLER ?>/add_blog.controller.php",
            dataType: "json",
            type: "POST",
            data: {
                task: "check_slug_availability",
                slug: window.slug,
                token: window.token
            },
            success: function(data) {
                console.log(data);
                if (data["status"] == true) {
                    window.slug_for_token = window.slug;
                    $.ajax({
                        url: "<?= URL_CONTROLLER ?>/add_blog.controller.php",
                        dataType: "json",
                        type: "POST",
                        data: {
                            task: "save_page_elements",
                            page_elements: page_elements,
                            slug: window.slug_for_token,
                            token: window.token
                        },
                        success: function(data) {
                            console.log(data);
                        }
                    })
                }
                if (data["status"] == false) {
                    $("#save_btn").click();
                }
            }
        });
        // console.log(page_elements);

        // let sr_no = $(".current_element_to_edit").attr("data-sr-no");
        // if (sr_no == 0) {
        //     if (window.slug_for_token == "") {
        //         window.slug = generate_new_slug(window.current_heading_element_value, "first");
        //         // window.title = window.current_heading_element_value;
        //     } else {
        //         window.slug = window.slug_for_token;
        //     }
        //     window.title = window.current_heading_element_value;
        // }

        // let element = ($(this).closest('.preview_element_div').children('.preview_element').prop('outerHTML'));

        // // alert(element);
        // // save element to the database
        // $('#edit_heading_setting').remove();
        // $(this).parent().remove();
        // is_element_active = false;
        // if (actively_edited_element == "heading_element") {
        //     window.saved_heading_element_value = window.current_heading_element_value;
        //     window.saved_heading_element_h = window.current_heading_element_h;
        //     window.saved_heading_element_color = window.current_heading_element_color;
        //     window.saved_heading_element_tag = window.current_heading_element_tag;
        //     window.saved_heading_element_text_alignment = window.current_heading_element_text_alignment;
        //     // check if slug is availabel
        //     function check_slug_availability() {
        //         $.ajax({
        //             url:  /add_blog.controller.php",
        //             dataType: "json",
        //             type: "POST",
        //             data: {
        //                 task: "check_slug_availability",
        //                 slug: window.slug,
        //                 token: window.token
        //             },
        //             success: function(data) {
        //                 if (data["status"] == false) {
        //                     window.slug = generate_new_slug(window.current_heading_element_value, result);
        //                     // recursive function
        //                     check_slug_availability();
        //                 } else {
        //                     window.slug_for_token = window.slug;
        //                     alert(`token before ajax ${window.token}`);
        //                     if (data["status"] == true) {
        //                         $.ajax({
        //                             url: /add_blog.controller.php",
        //                             dataType: "json",
        //                             type: "POST",
        //                             data: {
        //                                 task: "save_heading_element",
        //                                 token: window.token,
        //                                 slug: window.slug_for_token,
        //                                 title: window.saved_heading_element_value,
        //                                 sr_no: sr_no,
        //                                 element_name: "heading_element",
        //                                 element_id: window.actively_edited_element_id,
        //                                 value: window.saved_heading_element_value,
        //                                 h: window.saved_heading_element_h,
        //                                 color: window.saved_heading_element_color,
        //                                 tag: window.saved_heading_element_tag,
        //                                 text_alignment: window.saved_heading_element_text_alignment
        //                             },
        //                             success: function(data) {
        //                                 if (data["status"] == true) {
        //                                     window.slug_for_token = window.slug;
        //                                     alert(window.slug_for_token);
        //                                 }
        //                                 if (data["status"] == false) {
        //                                     // if (confirm("The title already exist do you really want to keep it ?")) {
        //                                     //     alert("Okay");
        //                                     //     generate_new_slug();

        //                                     // } else {
        //                                     //     alert("Okay, then please change it");
        //                                     // }
        //                                 }
        //                             }
        //                         });
        //                     }
        //                 }
        //             }
        //         });
        //     }
        //     check_slug_availability();
        //     // if (generate_new_slug()) {
        //     //     window.slug =
        //     // } else {
        //     //     window.slug = window.slug;
        //     // }
        //     console.log({
        //         task: "save_heading_element",
        //         token: window.token,
        //         slug: window.slug,
        //         value: window.saved_heading_element_value,
        //         element_name: "heading_element",
        //         element_id: window.actively_edited_element_id,
        //         h: window.saved_heading_element_h,
        //         color: window.saved_heading_element_color,
        //         sr_no: sr_no,
        //         tag: window.saved_heading_element_tag,
        //         text_alignment: window.saved_heading_element_text_alignment
        //     });
        //     // let object = {
        //     //     "tag": window.saved_heading_element_tag,
        //     //     "h": window.saved_heading_element_h,
        //     //     "color": window.saved_heading_element_color,
        //     //     "text_alignment": window.saved_heading_element_text_alignment
        //     // };

        //     $(".preview_element_div").removeClass("current_element_to_edit");
        // };
    });
    //------------------------------------------------------- to save single element
    $(document).on("click", "#save_btn_1", function() {
        // alert("save_btn_1");
        if (actively_edited_element == "heading_element") {
            $('#edit_heading_setting').remove();
            $(".preview_element_div").removeClass("current_element_to_edit");
            is_element_active = false;
        } else if (actively_edited_element == "text_editor_element") {
            $(".Editor-container").remove();
            $("#edit_elements .current_element_to_edit").remove();
            $(".preview_element_div").removeClass("current_element_to_edit");
            is_element_active = false;
        } else if (actively_edited_element == "image_element") {
            $("#edit_image_element_setting").remove();
            $(".preview_element_div").removeClass("current_element_to_edit");
            is_element_active = false;
        } else if (window.actively_edited_element == "video_element") {
            $("#edit_video_element_setting").remove();
            $(".preview_element_div").removeClass("current_element_to_edit");
            is_element_active = false;
        }
        // $('#edit_heading_setting').remove();
        $(this).parent().remove();
        $(".preview_element_div").removeClass("current_element_to_edit");
    });
    // cancel action
    // $(document).on("click", "#cancel_btn", function() {
    //     // read and populate previously stored data to the element from data base
    //     $('#edit_heading_setting').remove();
    //     $(this).parent().remove();
    //     $(".preview_element_div").removeClass("current_element_to_edit");
    //     is_element_active = false;
    // });
    // //------------------------------------------------------- delete action
    $(document).on("click", "#delete_btn_1", function() {
        if (confirm("Do you want to delete this element?")) {
            if (actively_edited_element == "heading_element") {
                $('#edit_heading_setting').remove();
                $(".current_element_to_edit").remove();
            } else if (actively_edited_element == "text_editor_element") {
                $(".Editor-container").remove();
                $(".current_element_to_edit").remove();
            } else if (actively_edited_element == "image_element") {
                $(".current_element_to_edit").remove();
                $("#edit_image_element_setting").remove();
            } else if (actively_edited_element = "video_element") {
                $(".current_element_to_edit").remove();
                $("#edit_video_element_setting").remove();
            }
            $(this).parent().parent().remove();
            // read and populate previously stored data to the element from data base
            let id = $(this).parent().parent().attr("id");
            // let msg = "this id is getting deleted :-"+id; 
            elements_id_array = jQuery.grep(elements_id_array, function(value) {
                return value != id;
            });
            // $(this).closest(".preview_element_div").removeClass(".current_element_to_edit");
            is_element_active = false;
        } else {
            alert("Okay");
        }
    });
    // ------------------------------------------- section 3 - Edit Element

    // adding corrosponding editing element
    // heading element edit settings  
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
                            <input type="color" id="heading_color_input_id" name="heading_color_input_id" style="min-height:25px" value="#000000">
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
    // heading element edit settings  
    // text editor element edit settings  
    function edit_texteditor_setting(text, actively_edited_element, id, texteditor_setting_code) {
        // https://github.com/suyati/line-control
        if (actively_edited_element == "text_editor_element") {
            let edit_elements_html = `<div class="row-fluid Editor-container">${texteditor_setting_code}</div>`;
            $("#edit_elements").append(edit_elements_html);
        }
    };
    // image editor element edit settings  
    function edit_image_element(actively_edited_element, id) {
        let edit_elements_html = `
                    <div id="edit_image_element_setting" data-active-element-id="${id}">
                    <form action="" id="image_form_id">
                        <div class="input-images form-control"></div>
                        <input type="file" class="form-control" alt="Submit" style="display:none">
                        <button type="button" class="btn btn-light btn-image-upload">Submit</button>
                    </form>
                    </div>`;
        $("#edit_elements").append(edit_elements_html);
        $('.input-images').imageUploader({
            extensions: ['.jpg', '.jpeg', '.png', '.gif', '.svg'],
            maxFiles: 1,
            label: 'Drag & Drop files here or click to browse'
        });
        $(document).on("click", ".btn-image-upload", function() {
            src = $(".uploaded-image").children("img").attr("src") ? $(".uploaded-image").children("img").attr("src") : "http://localhost/yavnik/_code/blog_managment_system/images/blank.png";
            console.log(5);
            $(`#${window.actively_edited_element_id}`).children(".image_element").children("img").attr("src", `${src}`);
            console.log(6);
        });
    };
    // /image editor element edit

    // video editor element edit settings  
    function edit_video_element(actively_edited_element, id) {
        let edit_elements_html = `
                    <div id="edit_video_element_setting" data-active-element-id="${id}">
                    <form action="" id="video_form_id">
                        <lable for="url_for_video"><b>Put Embeded Link Here</b></lable>
                        <input type="text" id="url_for_video" class="form-control" alt="Submit">
                        <button type="button" class="btn btn-light btn-video-upload">Submit</button>
                    </form>
                    </div>`;
        $("#edit_elements").append(edit_elements_html);
        $(document).on("click", ".btn-video-upload", function() {
            let link = $("#url_for_video").val();
            $(`#${window.actively_edited_element_id}`).children(".video_element").children("iframe").attr("src", `${link}`);
        });
    };
    // /video editor element edit settings

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