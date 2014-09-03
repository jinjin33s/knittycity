<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

$config = array
    (
    'comment' => array
        (
        array
            (
            'field' => 'comment_author_name',
            'label' => 'Name',
            'rules' => 'trim|required|xss_clean|htmlspecialchars'
        ),
        array
            (
            'field' => 'comment_author_email',
            'label' => 'E-mail',
            'rules' => 'trim|required|valid_email|xss_clean|htmlspecialchars'
        ),
        array
            (
            'field' => 'comment_author_website',
            'label' => 'Website',
            'rules' => 'trim|xss_clean|htmlspecialchars'
        ),
        array
            (
            'field' => 'comment_content',
            'label' => 'Content',
            'rules' => 'trim|required|xss_clean|htmlspecialchars'
        )
    ),
    'comment_logged_in' => array
        (
        array
            (
            'field' => 'comment_content',
            'label' => 'Content',
            'rules' => 'trim|required|xss_clean|htmlspecialchars'
        )
    ),
    'comment_admin' => array
        (
        array
            (
            'field' => 'comment_content',
            'label' => 'Content',
            'rules' => 'trim|required|xss_clean|htmlspecialchars'
        ),
        array
            (
            'field' => 'comment_is_approved',
            'label' => 'Approved',
            'rules' => 'trim|required|xss_clean|htmlspecialchars'
        )
    ),
    'search' => array
        (
        array
            (
            'field' => 'search_term',
            'label' => 'Search term',
            'rules' => 'trim|required|xss_clean|htmlspecialchars'
        )
    ),
    'login' => array
        (
        array
            (
            'field' => 'user_name',
            'label' => 'Name',
            'rules' => 'trim|required|xss_clean|htmlspecialchars'
        ),
        array
            (
            'field' => 'user_password',
            'label' => 'Password',
            'rules' => 'trim|required|xss_clean|htmlspecialchars'
        )
    ),
    'register' => array
        (
        array
            (
            'field' => 'user_name',
            'label' => 'Username',
            'rules' => 'trim|required|xss_clean|htmlspecialchars'
        ),
        array
            (
            'field' => 'user_password',
            'label' => 'Password',
            'rules' => 'trim|required|xss_clean|htmlspecialchars|matches[user_password_conf]'
        ),
        array
            (
            'field' => 'user_password_conf',
            'label' => 'Password confirmation',
            'rules' => 'trim|required|xss_clean|htmlspecialchars'
        ),
        array
            (
            'field' => 'user_email',
            'label' => 'E-mail',
            'rules' => 'trim|required|xss_clean|htmlspecialchars|valid_email|matches[user_email_conf]'
        ),
        array
            (
            'field' => 'user_email_conf',
            'label' => 'E-mail confirmation',
            'rules' => 'trim|required|xss_clean|htmlspecialchars|valid_email'
        )
    ),
    'forgotpassword' => array
        (
        array
            (
            'field' => 'user_email',
            'label' => 'lang:E-mail',
            'rules' => 'trim|required|xss_clean|htmlspecialchars|valid_email'
        )
    ),
    'post' => array
        (
        array
            (
            'field' => 'post_title',
            'label' => 'Title',
            'rules' => 'trim|required|xss_clean|htmlspecialchars'
        ),
        array
            (
            'field' => 'post_content',
            'label' => 'Content',
            'rules' => 'required|xss_clean'
        ),
        array
            (
            'field' => 'post_excerpt',
            'label' => 'Excerpt',
            'rules' => 'trim|xss_clean'
        ),
        array
            (
            'field' => 'category_id[]',
            'label' => 'Categories',
            'rules' => 'trim|xss_clean|htmlspecialchars'
        ),
        array
            (
            'field' => 'tags',
            'label' => 'Tags',
            'rules' => 'trim|xss_clean|htmlspecialchars'
        ),
        array
            (
            'field' => 'categories',
            'label' => 'New category',
            'rules' => 'trim|xss_clean|htmlspecialchars'
        ),
        array
            (
            'field' => 'post_is_published',
            'label' => 'Publish',
            'rules' => 'trim|required|xss_clean|htmlspecialchars'
        ),
        array
            (
            'field' => 'trackbacks',
            'label' => 'Trackback urls',
            'rules' => 'trim|xss_clean|htmlspecialchars'
        ),
        array
            (
            'field' => 'post_trackback_is_allowed',
            'label' => 'Trackbacks are allowed',
            'rules' => 'trim|required|xss_clean|htmlspecialchars'
        ),
        array
            (
            'field' => 'post_date_publish',
            'label' => 'post date',
            'rules' => 'trim|required|xss_clean|htmlspecialchars'
        ),
    ),
    'post_delete' => array
        (
        array
            (
            'field' => 'post_id[]',
            'label' => 'Posts',
            'rules' => 'trim|xss_clean|htmlspecialchars'
        ),
    ),
    'tag_delete' => array
        (
        array
            (
            'field' => 'tag_id[]',
            'label' => 'Tags',
            'rules' => 'trim|xss_clean|htmlspecialchars'
        ),
    ),
    'category_delete' => array
        (
        array
            (
            'field' => 'category_id[]',
            'label' => 'Categories',
            'rules' => 'trim|xss_clean|htmlspecialchars'
        ),
    ),
    'page_delete' => array
        (
        array
            (
            'field' => 'page_id[]',
            'label' => 'Pages',
            'rules' => 'trim|xss_clean|htmlspecialchars'
        ),
    ),
    'group_delete' => array
        (
        array
            (
            'field' => 'group_id[]',
            'label' => 'Groups',
            'rules' => 'trim|xss_clean|htmlspecialchars'
        ),
    ),
    'link_delete' => array
        (
        array
            (
            'field' => 'link_id[]',
            'label' => 'Links',
            'rules' => 'trim|xss_clean|htmlspecialchars'
        ),
    ),
    'file_delete' => array
        (
        array
            (
            'field' => 'file_id[]',
            'label' => 'Files',
            'rules' => 'trim|xss_clean|htmlspecialchars'
        ),
    ),
        'kclass_delete' => array
        (
        array
            (
            'field' => 'class_id[]',
            'label' => 'Kclasses',
            'rules' => 'trim|xss_clean|htmlspecialchars'
        ),
    ),
         'kevent_delete' => array
        (
        array
            (
            'field' => 'event_id[]',
            'label' => 'Kevents',
            'rules' => 'trim|xss_clean|htmlspecialchars'
        ),

    ),
        'kcalendar_delete' => array
        (
        array
            (
            'field' => 'calendar_id[]',
            'label' => 'Kcalendars',
            'rules' => 'trim|xss_clean|htmlspecialchars'
        ),
    ),

        'kprofile_delete' => array
        (
        array
            (
            'field' => 'prof_id[]',
            'label' => 'Profiles',
            'rules' => 'trim|xss_clean|htmlspecialchars'
        ),
    ),

        'subscriber_delete' => array
        (
        array
            (
            'field' => 'subscriber_id[]',
            'label' => 'Subscriber ',
            'rules' => 'trim|xss_clean|htmlspecialchars'
        ),
    ),
    'page' => array
        (
        array
            (
            'field' => 'page_title',
            'label' => 'Title',
            'rules' => 'trim|required|xss_clean|htmlspecialchars'
        ),
        array
            (
            'field' => 'page_content',
            'label' => 'Content',
            'rules' => 'trim|required|xss_clean'
        ),
        array
            (
            'field' => 'page_is_published',
            'label' => 'Publish',
            'rules' => 'trim|required|xss_clean|htmlspecialchars'
        ),
    ),
    'user' => array
        (
        array
            (
            'field' => 'user_email',
            'label' => 'E-Mail',
            'rules' => 'trim|required|xss_clean|htmlspecialchars'
        ),
        array
            (
            'field' => 'user_website',
            'label' => 'Website',
            'rules' => 'trim|xss_clean|htmlspecialchars'
        ),
        array
            (
            'field' => 'group_id[]',
            'label' => 'Groups',
            'rules' => 'trim|xss_clean|htmlspecialchars'
        ),
    ),
    'change_password' => array
        (
        array
            (
            'field' => 'user_password',
            'label' => 'New password',
            'rules' => 'trim|required|xss_clean|htmlspecialchars|matches[user_password_conf]'
        ),
        array
            (
            'field' => 'user_password_conf',
            'label' => 'Password confirmation',
            'rules' => 'trim|required|xss_clean|htmlspecialchars'
        )
    ),
    'change_own_password' => array
        (
        array
            (
            'field' => 'current_password',
            'label' => 'Current password',
            'rules' => 'trim|required|xss_clean|htmlspecialchars'
        ),
        array
            (
            'field' => 'user_password',
            'label' => 'New password',
            'rules' => 'trim|required|xss_clean|htmlspecialchars|matches[user_password_conf]'
        ),
        array
            (
            'field' => 'user_password_conf',
            'label' => 'Password confirmation',
            'rules' => 'trim|required|xss_clean|htmlspecialchars'
        )
    ),
    'group' => array
        (
        array
            (
            'field' => 'group_name',
            'label' => 'Name',
            'rules' => 'trim|required|xss_clean|htmlspecialchars'
        ),
        array
            (
            'field' => 'right_id[]',
            'label' => 'Rights',
            'rules' => 'trim|xss_clean|htmlspecialchars'
        ),
    ),
    'config' => array
        (
        array
            (
            'field' => 'config_blog_title',
            'label' => 'Blog title',
            'rules' => 'trim|required|xss_clean|htmlspecialchars'
        ),
        array
            (
            'field' => 'config_blog_sub_title',
            'label' => 'Sub title',
            'rules' => 'trim|xss_clean|htmlspecialchars'
        ),
        array
            (
            'field' => 'config_meta_description',
            'label' => 'Site description',
            'rules' => 'trim|xss_clean|htmlspecialchars'
        ),
        array
            (
            'field' => 'config_meta_keywords',
            'label' => 'Keywords',
            'rules' => 'trim|xss_clean|htmlspecialchars'
        ),
        array
            (
            'field' => 'config_blog_entries_per_page',
            'label' => 'Blog entries per page',
            'rules' => 'trim|required|xss_clean|htmlspecialchars|is_natural_no_zero'
        ),
        array
            (
            'field' => 'config_comments_per_page',
            'label' => 'Comments per page',
            'rules' => 'trim|required|xss_clean|htmlspecialchars|is_natural_no_zero'
        ),
        array
            (
            'field' => 'config_date_format',
            'label' => 'Date format',
            'rules' => 'trim|required|xss_clean|htmlspecialchars'
        ),
        array
            (
            'field' => 'config_date_time_format',
            'label' => 'Date time format',
            'rules' => 'trim|required|xss_clean|htmlspecialchars'
        ),
        array
            (
            'field' => 'config_small_date_format',
            'label' => 'Small date format',
            'rules' => 'trim|required|xss_clean|htmlspecialchars'
        ),
        array
            (
            'field' => 'config_navigation_items',
            'label' => 'Show search in navigation',
            'rules' => 'trim|xss_clean|htmlspecialchars'
        ),
        array
            (
            'field' => 'config_navigation_show_post_overview',
            'label' => 'Show link to post overview in navigation',
            'rules' => 'trim|required|xss_clean|htmlspecialchars'
        ),
        array
            (
            'field' => 'config_navigation_show_search',
            'label' => 'Show search in navigation',
            'rules' => 'trim|required|xss_clean|htmlspecialchars'
        ),
        array
            (
            'field' => 'config_navigation_show_meta',
            'label' => 'Show meta links in navigation',
            'rules' => 'trim|required|xss_clean|htmlspecialchars'
        ),
        array
            (
            'field' => 'config_not_logged_in_user_group_id',
            'label' => 'Group for not logged in users',
            'rules' => 'trim|required|xss_clean|htmlspecialchars'
        ),
        array
            (
            'field' => 'config_new_user_group_id',
            'label' => 'Default group for new users',
            'rules' => 'trim|required|xss_clean|htmlspecialchars'
        ),
        array
            (
            'field' => 'config_design_folder',
            'label' => 'Design folder',
            'rules' => 'trim|required|xss_clean|htmlspecialchars'
        ),
        array
            (
            'field' => 'config_enable_registration',
            'label' => 'Enable registration',
            'rules' => 'trim|required|xss_clean|htmlspecialchars'
        ),
        array
            (
            'field' => 'config_google_tracker_id',
            'label' => 'Google tracker ID',
            'rules' => 'trim|xss_clean|htmlspecialchars'
        ),
        array
            (
            'field' => 'config_owner_name',
            'label' => 'Owner name',
            'rules' => 'trim|required|xss_clean|htmlspecialchars'
        ),
        array
            (
            'field' => 'config_owner_email',
            'label' => 'Owner e-mail',
            'rules' => 'trim|required|valid_email|xss_clean|htmlspecialchars'
        ),
        array
            (
            'field' => 'config_start_page',
            'label' => 'Start page',
            'rules' => 'trim|required|xss_clean|htmlspecialchars'
        ),
        array
            (
            'field' => 'config_show_social_bookmarking_links',
            'label' => 'Show social bookmarking links',
            'rules' => 'trim|required|xss_clean|htmlspecialchars'
        ),
    ),
    'link' => array
        (
        array
            (
            'field' => 'link_title',
            'label' => 'Title',
            'rules' => 'trim|required|xss_clean|htmlspecialchars'
        ),
        array
            (
            'field' => 'link_url',
            'label' => 'Url',
            'rules' => 'trim|required|xss_clean|htmlspecialchars'
        ),
        array
            (
            'field' => 'link_is_blog',
            'label' => 'Is blog',
            'rules' => 'trim|required|xss_clean|htmlspecialchars'
        ),
    ),
    'file' => array
        (
        array
            (
            'field' => 'file_title',
            'label' => 'Title',
            'rules' => 'trim|required|xss_clean|htmlspecialchars'
        ),
        array
            (
            'field' => 'file_mirror',
            'label' => 'Mirrors',
            'rules' => 'trim|required|xss_clean|htmlspecialchars'
        ),
        array
            (
            'field' => 'file_description',
            'label' => 'Description',
            'rules' => 'trim|xss_clean'
        ),
        array
            (
            'field' => 'file_size',
            'label' => 'Size',
            'rules' => 'trim|xss_clean|htmlspecialchars'
        ),
        array
            (
            'field' => 'file_is_online',
            'label' => 'Is online',
            'rules' => 'trim|required|xss_clean|htmlspecialchars'
        ),
    ),
    'contact' => array
        (
        array
            (
            'field' => 'contact_name',
            'label' => 'Name',
            'rules' => 'trim|required|xss_clean|htmlspecialchars'
        ),
        array
            (
            'field' => 'contact_email',
            'label' => 'E-mail',
            'rules' => 'trim|required|valid_email|xss_clean|htmlspecialchars'
        ),
        array
            (
            'field' => 'contact_subject',
            'label' => 'Subject',
            'rules' => 'trim|required|xss_clean|htmlspecialchars'
        ),
        array
            (
            'field' => 'contact_content',
            'label' => 'Content',
            'rules' => 'trim|required|xss_clean|htmlspecialchars'
        )
    ),
    'trackback' => array
        (
        array
            (
            'field' => 'url',
            'label' => 'URL',
            'rules' => 'trim|required|xss_clean|htmlspecialchars'
        ),
        array
            (
            'field' => 'excerpt',
            'label' => 'Excerpt',
            'rules' => 'trim|xss_clean|htmlspecialchars'
        ),
        array
            (
            'field' => 'title',
            'label' => 'Title',
            'rules' => 'trim|xss_clean|htmlspecialchars'
        ),
        array
            (
            'field' => 'blog_name',
            'label' => 'Blog name',
            'rules' => 'trim|xss_clean|htmlspecialchars'
        )
    ),
    'kclass' => array
        (
        array
            (
            'field' => 'classTitle',
            'label' => 'Title',
            'rules' => 'trim|required|xss_clean|htmlspecialchars'
        ),
        array
            (
            'field' => 'classInstructor',
            'label' => 'Instructor',
            'rules' => 'trim|required|xss_clean|htmlspecialchars'
        ),
        array
            (
            'field' => 'classDate',
            'label' => 'class date',
            'rules' => 'trim|required|xss_clean|htmlspecialchars'
        ),
        array
            (
            'field' => 'classTime',
            'label' => 'class time',
            'rules' => 'trim|required|xss_clean|htmlspecialchars'
        ),
        array
            (
            'field' => 'classEndTime',
            'label' => 'class end time',
            'rules' => 'trim|required|xss_clean|htmlspecialchars'
        ),
        array
            (
            'field' => 'classContent',
            'label' => 'Content',
            'rules' => 'trim|required|xss_clean'
        ),
        array
            (
            'field' => 'classLocation',
            'label' => 'Location',
            'rules' => 'trim|xss_clean|htmlspecialchars'
        )
    ),
     'kevent' => array
        (
        array
            (
            'field' => 'eventTitle',
            'label' => 'Title',
            'rules' => 'trim|required|xss_clean|htmlspecialchars'
        ),
        array
            (
            'field' => 'eventDate',
            'label' => 'event date',
            'rules' => 'trim|required|xss_clean|htmlspecialchars'
        ),
        array
            (
            'field' => 'eventTime',
            'label' => 'event time',
            'rules' => 'trim|required|xss_clean|htmlspecialchars'
        ),
        array
            (
            'field' => 'eventEndDate',
            'label' => 'event end date',
            'rules' => 'trim|xss_clean|htmlspecialchars'
        ),
        array
            (
            'field' => 'eventEndTime',
            'label' => 'event end time',
            'rules' => 'trim|xss_clean|htmlspecialchars'
        ),
        array
            (
            'field' => 'eventLocation',
            'label' => 'Location',
            'rules' => 'trim|xss_clean'
        )
    ),
    'kcalendar' => array
        (
        array
            (
            'field' => 'calendarTitle',
            'label' => 'Title',
            'rules' => 'trim|required|xss_clean|htmlspecialchars'
        ),
        array
            (
            'field' => 'calendarDate',
            'label' => 'calendar date',
            'rules' => 'trim|required|xss_clean|htmlspecialchars'
        ),        
        array
            (
            'field' => 'calendarEndDate',
            'label' => 'calendar end date',
            'rules' => 'trim|xss_clean'
        ),  
        array
            (
            'field' => 'calendarLocation',
            'label' => 'Location',
            'rules' => 'trim|xss_clean'
        ),
         array
            (
            'field' => 'cclendarContent',
            'label' => 'Content',
            'rules' => 'trim|xss_clean|htmlspecialchars'
        )
    ),
     'kprofile' => array
        (
        array
            (
            'field' => 'profTitle',
            'label' => 'Title',
            'rules' => 'trim|xss_clean|htmlspecialchars'
        ),
         array
            (
            'field' => 'profSummary',
            'label' => 'Summary',
            'rules' => 'trim|xss_clean|htmlspecialchars'
        ),
        array
            (
            'field' => 'profPicture',
            'label' => 'Picture',
            'rules' => 'trim|xss_clean|htmlspecialchars'
        ),
        array
            (
            'field' => 'profDate',
            'label' => 'profile date',
            'rules' => 'trim|required|xss_clean|htmlspecialchars'
        ),
        array
            (
            'field' => 'profContent',
            'label' => 'Content',
            'rules' => 'trim|required|xss_clean'
        ),
    ),
     'subscriber' => array
        (
        array
            (
            'field' => 'firstName',
            'label' => 'First Name',
            'rules' => 'trim|xss_clean|htmlspecialchars'
        ),
        array
            (
            'field' => 'lastName',
            'label' => 'Last Name',
            'rules' => 'trim|xss_clean|htmlspecialchars'
        ),
        array
            (
            'field' => 'regDate',
            'label' => 'Register Date',
            'rules' => 'trim|xss_clean|htmlspecialchars'
        ),
    )

);