// JavaScript Document

$(document).ready(function() {

    $('body').on('submit', '.marks-form', function() {
        $('body').addClass('hidden_overflow').prepend('<div id="my_loader">' +
            '<img src="/images/loader.gif" class="loader-marks" alt="">' +
        '</div>');
    });

    $('body').on('change', '.mark_type_title', function() {
        var number, val, title_for_marks_sheet, array_titles_value, i, class_id;

        number = $(this).data('number-column');
        val = $(this).val();
        class_id = $('.adding-marks-class-id').val();

        array_titles_value = [];

        $('.mark_type_title').each(function() {
            array_titles_value[$(this).data('number-column')] = $(this).val();
        });

        $.ajax({
            url: 'check-under-title-for-marks',
            type: 'POST',
            data: ({
                action: 'check_titles',
                array_titles_value: array_titles_value,
                subject_id: $('.adding-marks-subject-id').val(),
                class_id: class_id
            }),
            dataType: "json",
            beforeSend: function() {
                $('body').addClass('hidden_overflow').prepend('<div id="my_loader">' +
                        '<img src="/images/loader.gif" class="loader-marks" alt="">' +
                    '</div>');
            },
            success: function(data) {
                $('body').removeClass('hidden_overflow');
                $('#my_loader').remove();

                $('.mark_type_title').html('');

                for (var u = 0; u < data['list_of_items'].length; u++) {
                    for (var k in data['list_of_items'][u]) {
                        $('.mark_type_title[data-number-column="'+u+'"]').append('<option value="'+k+'">'+data['list_of_items'][u][k]+'</option>');
                    }
                }

                $('.mark_type_title').each(function() {
                    if ($(this).children('option[value="0"]').length == 0) {
                        $(this).prepend('<option value="0">Без теми</option>');
                    }
                });

                for (var s = 0; s < data['selected_items'].length; s++) {
                    $('.mark_type_title[data-number-column="'+s+'"] option[value="'+data['selected_items'][s]+'"]').attr('selected', true);
                    $('.hidden_type_mark_'+s).val(data['selected_items'][s]);
                }
                
            },
            error: function() {
                $('body').removeClass('hidden_overflow');
                $('#my_loader').remove();
                $('.sheet-adding-marks-wrap').html('Трапилася помилка');
            }
        });

    });

    var previous_value_of_date;

    $('body').on('focus', '.date_for_adding_marks', function() {
        previous_value_of_date = $(this).val();
    
    }).on('change', '.date_for_adding_marks', function() {
        
        if (previous_value_of_date != '') {
            var date, subject_id, class_id;

            class_id = $('.adding-marks-class-id').val();
            date = $('.date_for_adding_marks').val();
            subject_id = $('.adding-marks-subject-id').val();

            $.ajax({
                url: 'check-date-for-adding-marks',
                type: 'POST',
                data: ({
                    action: 'check_date',
                    date: date,
                    subject_id: subject_id,
                    class_id: class_id
                }),
                dataType: "json",
                beforeSend: function() {
                    $('body').addClass('hidden_overflow').prepend('<div id="my_loader">' +
                            '<img src="/images/loader.gif" class="loader-marks" alt="">' +
                        '</div>');
                },
                success: function(data) {
                    $('body').removeClass('hidden_overflow');
                    $('#my_loader').remove();
                    $('.sheet-adding-marks-wrap').html(data);
                },
                error: function() {
                    $('body').removeClass('hidden_overflow');
                    $('#my_loader').remove();
                    $('.sheet-adding-marks-wrap').html('Трапилася помилка');
                }
            });
        }

        previous_value_of_date = $(this).val();
    });

    $('body').on('click', '.show-marks-btn', function() {
        var date, subject_id, class_id;

        class_id = $('.adding-marks-class-id').val();
        date = $('.date_for_adding_marks').val();
        subject_id = $('.adding-marks-subject-id').val();

        if (date == '') {
            $('.field-marks-date .help-block').html('Необхідно заповнити "Дата".');
            $('.field-marks-date').addClass('has-error');
        } else {
            $.ajax({
                url: 'check-date-for-adding-marks',
                type: 'POST',
                data: ({
                    action: 'check_date',
                    date: date,
                    subject_id: subject_id,
                    class_id: class_id
                }),
                dataType: "json",
                beforeSend: function() {
                    $('body').addClass('hidden_overflow').prepend('<div id="my_loader">' +
                            '<img src="/images/loader.gif" class="loader-marks" alt="">' +
                        '</div>');
                },
                success: function(data) {
                    $('body').removeClass('hidden_overflow');
                    $('#my_loader').remove();
                    $('.sheet-adding-marks-wrap').html(data);
                },
                error: function() {
                    $('body').removeClass('hidden_overflow');
                    $('#my_loader').remove();
                    $('.sheet-adding-marks-wrap').html('Трапилася помилка');
                }
            });
        }
    });

    $('body').on('keyup', '.date_for_adding_marks', function(event) {

        var x = event.which || event.keyCode;
        if (x == 13) {
            $('.show-marks-btn').focus().click();
        }
        return false;

    });

	$('body').on('click', '.btn-edit-lessons-schedule', function() {

		var this_subject, subject_id, parent_table, lesson_number, day, class_id, html, parent_tr, count_of_changed_lessons, i, 
			changed_html, span, empty_html, desktop_tr, mobile_tr;
        var span_array = [];

        this_subject = $(this);
        parent_table = this_subject.parents('table');
        subject_id = this_subject.data('id');
        lesson_number = this_subject.data('lesson_number');
        class_id = $('.hidden_class_id').val();
        day = $('.hidden_day').val();
        parent_tr = this_subject.parent('td').parent('tr');

        this_subject.css({'opacity' : '.7'}).children('i').attr({'class' : 'fa fa-spinner fa-spin fa-1x fa-fw'}).css({'margin-left' : 0, 'margin-right' : '-2px'});

        $.ajax({
            url: "lessons-schedule-edit?id="+class_id+"&day="+day,
            type: "POST",
            data: ({
                action: 'remove-lesson-from-schedule',
                class_id: class_id,
                day: day,
                subject_id: subject_id,
                lesson_number: lesson_number
            }),
            dataType: "json",
            success: function(data) {
                if (data['answer'] == 'removed') {

                	$('#ajax-answer').html('');
                    this_subject.remove();
                    
                    html = '<div class="alert alert-success alert-dismissible" role="alert">' +
                        '<button type="button" class="close" data-dismiss="alert" aria-label="Close">' +
                        '<span aria-hidden="true">×</span></button>Предмет успішно видалено з розкладу!</div>';

		        	count_of_changed_lessons = parent_tr.find('.wrap-of-lessons').children('.btn.btn-edit-lessons-schedule').length;
                   
                    desktop_tr = $('.hidden-lg.hidden-md.hidden-sm.col-xs-12 tr[data-lesson_number_id="'+parent_tr.attr('data-lesson_number_id')+'"]');
		        	mobile_tr = $('.col-lg-6.col-md-6.col-sm-6.hidden-xs tr[data-lesson_number_id="'+parent_tr.attr('data-lesson_number_id')+'"]');

                    if (count_of_changed_lessons == 0) {
			    		desktop_tr.remove();
			    		mobile_tr.remove();
			    	} else {
			    		if (count_of_changed_lessons == 1) {
			    			desktop_tr.find('.wrap-of-lessons').removeClass('several-lessons-background');
			    			mobile_tr.find('.wrap-of-lessons').removeClass('several-lessons-background');
			    		}

			    		i = 0;
			    		changed_html = [];
			    		parent_tr.find('.wrap-of-lessons').children('.btn.btn-edit-lessons-schedule').each(function() {
			    			span_array['html'] = $(this).html();
			    			span_array['class'] = $(this).attr('class');
			    			span_array['lesson_number'] = $(this).attr('data-lesson_number');
			    			span_array['id'] = $(this).attr('data-id');
			    			span_array['title'] = $(this).attr('title');
			    			span = '<span data-id="'+span_array['id']+'" title=\''+span_array['title']+'\' data-lesson_number="'+span_array['lesson_number']+'" class="'+span_array['class']+'">'+span_array['html']+'</span>';
			    			changed_html[i] = span;
			    			i++;
			    		});

				        desktop_tr.find('.wrap-of-lessons').html(changed_html.join(' <span class="schedule-slash">/</span> '));
			    		mobile_tr.find('.wrap-of-lessons').html(changed_html.join(' <span class="schedule-slash">/</span> '));
			    	}

			    	if (parent_table.find('tr[data-lesson_number_id]').length == 0) {
			    		$('.head_tr_lessons_schedule_edit').remove();
			    		empty_html = '<tr><td colspan="2">-</td></tr>';
			    		$('.lse-table').append(empty_html);
			    	}

			    	if (parent_table.find('.several-lessons-background').length == 0) {
			    		$('.yellow-tip').remove();
			    	}

                } else {
                    html = '<div class="alert alert-danger alert-dismissible" role="alert">' +
                        '<button type="button" class="close" data-dismiss="alert" aria-label="Close">' +
                        '<span aria-hidden="true">×</span></button>Виникла помилка з видаленням предмету з розкладу. Спробуйте перезавантажити сторінку і ще раз!</div>';

                	this_subject.css({'opacity' : '1'}).children('i').attr({'class' : 'fa fa-close'}).css({'margin-left' : '5px', 'margin-right' : 0});
                }

                $('#ajax-answer').html(html);

                setTimeout(function() {
                	$('#ajax-answer').html('');
                }, 5000);
            }
        });
	});

    $('.teachers-subjects-access-view select#classteacherssubjectsaccess-teacher_id').change(function() {

        $('.loader-ajax').html('<i class="fa fa-spinner fa-spin fa-1x fa-fw" aria-hidden="true"></i>');
        $('.checkbox-subjects-wrap input').removeAttr('checked');
        
        var this_select, this_val, class_id, i;

        class_id = $('.hidden_class_id').val();
        this_select = $(this);
        teacher_id = this_select.val();

        $.ajax({
            url: "teachers-subjects-access?id="+class_id,
            type: "POST",
            data: ({
                class_id: class_id,
                teacher_id: teacher_id
            }),
            dataType: "json",
            success: function(data) {
                for (i = 0; i < data.subjects.length; i++) {
                    $('.checkbox-subjects-wrap input[value="'+ data.subjects[i].subject_id +'"]').attr('checked', true);
                }
                $('.loader-ajax').html('');
            }
        });

    });

    $('.subjects-view .assigned_buttons .btn').click(function() {

        var this_button, target, needed, html, class_id, subjects, i, option, subject_name;
        
        this_button = $(this);
        target = this_button.data('target');
        needed = this_button.data('needed');
        html = this_button.html();

        if ($('#'+target+'_select').val().length > 0) {

            this_button.attr('disabled', true).html('<i class="fa fa-spinner fa-spin fa-1x fa-fw" aria-hidden="true"></i>');
            class_id = this_button.data('id');
            subjects = $('#'+target+'_select').val();

            $.ajax({
                url: "subjects?id="+class_id,
                type: "POST",
                data: ({
                    action: target,
                    class_id: class_id,
                    subjects: subjects
                }),
                dataType: "json",
                success: function(data) {
                    for (i = 0; i < data.subjects.length; i++) {
                        option = $('#'+target+'_select option[value="'+data.subjects[i]+'"]');
                        subject_name = option.text();
                        $('#'+needed+'_select optgroup').append('<option value="'+data.subjects[i]+'">'+subject_name+'</option>');
                        option.remove();
                    }
                    this_button.attr('disabled', false).html(html);
                }
            });
        }
    });

    $('.teachers-access-view .assigned_buttons .btn').click(function() {

        var this_button, target, needed, html, class_id, teachers, i, option, teacher_name;
        
        this_button = $(this);
        target = this_button.data('target');
        needed = this_button.data('needed');
        html = this_button.html();

        if ($('#'+target+'_select').val().length > 0) {

            this_button.attr('disabled', true).html('<i class="fa fa-spinner fa-spin fa-1x fa-fw" aria-hidden="true"></i>');
            class_id = this_button.data('id');
            teachers = $('#'+target+'_select').val();

            $.ajax({
                url: "teachers-access?id="+class_id,
                type: "POST",
                data: ({
                    action: target,
                    class_id: class_id,
                    teachers: teachers
                }),
                dataType: "json",
                success: function(data) {

                    for (i = 0; i < data.teachers.length; i++) {
                        option = $('#'+target+'_select option[value="'+data.teachers[i]+'"]');
                        teacher_name = option.text();
                        $('#'+needed+'_select optgroup').append('<option value="'+data.teachers[i]+'">'+teacher_name+'</option>');
                        option.remove();
                    }
                    this_button.attr('disabled', false).html(html);
                }
            });
        }
    });
});