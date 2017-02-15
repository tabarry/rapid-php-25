<?php
     $dbs_sulata_blank = 
        array(
        
            '__ID_req'=>'*',
            '__ID_title'=>'ID',
            '__ID_max'=>'11',
            '__ID_validateas'=>'int',
            '__ID_html5_req'=>'required',
            '__ID_html5_type'=>'text',
            
            
            '__Last_Action_On_req'=>'*',
            '__Last_Action_On_title'=>'Last Action On',
            '__Last_Action_On_max'=>'',
            '__Last_Action_On_validateas'=>'required',
            '__Last_Action_On_html5_req'=>'required',
            '__Last_Action_On_html5_type'=>'text',
            
            
            '__Last_Action_By_req'=>'*',
            '__Last_Action_By_title'=>'Last Action By',
            '__Last_Action_By_max'=>'64',
            '__Last_Action_By_validateas'=>'required',
            '__Last_Action_By_html5_req'=>'required',
            '__Last_Action_By_html5_type'=>'text',
            
            
            '__dbState_req'=>'*',
            '__dbState_title'=>'dbState',
            '__dbState_max'=>'',
            '__dbState_validateas'=>'enum',
            '__dbState_html5_req'=>'required',
            '__dbState_html5_type'=>'text',
            '__dbState_array'=>array(''=>'Select..','Live'=>'Live','Deleted'=>'Deleted',),
            
        );
    
    $dbs_sulata_faqs = 
        array(
        
            'faq__ID_req'=>'*',
            'faq__ID_title'=>'ID',
            'faq__ID_max'=>'11',
            'faq__ID_validateas'=>'int',
            'faq__ID_html5_req'=>'required',
            'faq__ID_html5_type'=>'text',
            
            
            'faq__Question_req'=>'*',
            'faq__Question_title'=>'Question',
            'faq__Question_max'=>'255',
            'faq__Question_validateas'=>'required',
            'faq__Question_html5_req'=>'required',
            'faq__Question_html5_type'=>'text',
            
            
            'faq__Answer_req'=>'*',
            'faq__Answer_title'=>'Answer',
            'faq__Answer_max'=>'',
            'faq__Answer_validateas'=>'required',
            'faq__Answer_html5_req'=>'required',
            'faq__Answer_html5_type'=>'text',
            
            
            'faq__Sequence_req'=>'*',
            'faq__Sequence_title'=>'Sequence',
            'faq__Sequence_max'=>'',
            'faq__Sequence_validateas'=>'required',
            'faq__Sequence_html5_req'=>'required',
            'faq__Sequence_html5_type'=>'text',
            
            
            'faq__Status_req'=>'*',
            'faq__Status_title'=>'Status',
            'faq__Status_max'=>'',
            'faq__Status_validateas'=>'enum',
            'faq__Status_html5_req'=>'required',
            'faq__Status_html5_type'=>'text',
            'faq__Status_array'=>array(''=>'Select..','Active'=>'Active','Inactive'=>'Inactive',),
            
            'faq__Last_Action_On_req'=>'*',
            'faq__Last_Action_On_title'=>'Last Action On',
            'faq__Last_Action_On_max'=>'',
            'faq__Last_Action_On_validateas'=>'required',
            'faq__Last_Action_On_html5_req'=>'required',
            'faq__Last_Action_On_html5_type'=>'text',
            
            
            'faq__Last_Action_By_req'=>'*',
            'faq__Last_Action_By_title'=>'Last Action By',
            'faq__Last_Action_By_max'=>'64',
            'faq__Last_Action_By_validateas'=>'required',
            'faq__Last_Action_By_html5_req'=>'required',
            'faq__Last_Action_By_html5_type'=>'text',
            
            
            'faq__dbState_req'=>'*',
            'faq__dbState_title'=>'dbState',
            'faq__dbState_max'=>'',
            'faq__dbState_validateas'=>'enum',
            'faq__dbState_html5_req'=>'required',
            'faq__dbState_html5_type'=>'text',
            'faq__dbState_array'=>array(''=>'Select..','Live'=>'Live','Deleted'=>'Deleted',),
            
        );
    
    $dbs_sulata_headers = 
        array(
        
            'header__ID_req'=>'*',
            'header__ID_title'=>'ID',
            'header__ID_max'=>'11',
            'header__ID_validateas'=>'int',
            'header__ID_html5_req'=>'required',
            'header__ID_html5_type'=>'text',
            
            
            'header__Title_req'=>'*',
            'header__Title_title'=>'Title',
            'header__Title_max'=>'64',
            'header__Title_validateas'=>'required',
            'header__Title_html5_req'=>'required',
            'header__Title_html5_type'=>'text',
            
            
            'header__Picture_req'=>'*',
            'header__Picture_title'=>'Picture',
            'header__Picture_max'=>'128',
            'header__Picture_validateas'=>'image',
            'header__Picture_html5_req'=>'required',
            'header__Picture_html5_type'=>'file',
            
            
            'header__Last_Action_On_req'=>'*',
            'header__Last_Action_On_title'=>'Last Action On',
            'header__Last_Action_On_max'=>'',
            'header__Last_Action_On_validateas'=>'required',
            'header__Last_Action_On_html5_req'=>'required',
            'header__Last_Action_On_html5_type'=>'text',
            
            
            'header__Last_Action_By_req'=>'*',
            'header__Last_Action_By_title'=>'Last Action By',
            'header__Last_Action_By_max'=>'64',
            'header__Last_Action_By_validateas'=>'required',
            'header__Last_Action_By_html5_req'=>'required',
            'header__Last_Action_By_html5_type'=>'text',
            
            
            'header__dbState_req'=>'*',
            'header__dbState_title'=>'dbState',
            'header__dbState_max'=>'',
            'header__dbState_validateas'=>'enum',
            'header__dbState_html5_req'=>'required',
            'header__dbState_html5_type'=>'text',
            'header__dbState_array'=>array(''=>'Select..','Live'=>'Live','Deleted'=>'Deleted',),
            
        );
    
    $dbs_sulata_media_categories = 
        array(
        
            'mediacat__ID_req'=>'*',
            'mediacat__ID_title'=>'ID',
            'mediacat__ID_max'=>'11',
            'mediacat__ID_validateas'=>'int',
            'mediacat__ID_html5_req'=>'required',
            'mediacat__ID_html5_type'=>'text',
            
            
            'mediacat__Name_req'=>'*',
            'mediacat__Name_title'=>'Name',
            'mediacat__Name_max'=>'64',
            'mediacat__Name_validateas'=>'required',
            'mediacat__Name_html5_req'=>'required',
            'mediacat__Name_html5_type'=>'text',
            
            
            'mediacat__Picture_req'=>'',
            'mediacat__Picture_title'=>'Picture',
            'mediacat__Picture_max'=>'128',
            'mediacat__Picture_validateas'=>'image',
            'mediacat__Picture_html5_req'=>'',
            'mediacat__Picture_html5_type'=>'file',
            
            
            'mediacat__Description_req'=>'',
            'mediacat__Description_title'=>'Description',
            'mediacat__Description_max'=>'',
            'mediacat__Description_validateas'=>'',
            'mediacat__Description_html5_req'=>'',
            'mediacat__Description_html5_type'=>'file',
            
            
            'mediacat__Type_req'=>'*',
            'mediacat__Type_title'=>'Type',
            'mediacat__Type_max'=>'',
            'mediacat__Type_validateas'=>'enum',
            'mediacat__Type_html5_req'=>'required',
            'mediacat__Type_html5_type'=>'text',
            'mediacat__Type_array'=>array(''=>'Select..','Image'=>'Image','File'=>'File',),
            
            'mediacat__Thumbnail_Width_req'=>'',
            'mediacat__Thumbnail_Width_title'=>'Thumbnail Width',
            'mediacat__Thumbnail_Width_max'=>'11',
            'mediacat__Thumbnail_Width_validateas'=>'int',
            'mediacat__Thumbnail_Width_html5_req'=>'',
            'mediacat__Thumbnail_Width_html5_type'=>'text',
            
            
            'mediacat__Thumbnail_Height_req'=>'',
            'mediacat__Thumbnail_Height_title'=>'Thumbnail Height',
            'mediacat__Thumbnail_Height_max'=>'11',
            'mediacat__Thumbnail_Height_validateas'=>'int',
            'mediacat__Thumbnail_Height_html5_req'=>'',
            'mediacat__Thumbnail_Height_html5_type'=>'text',
            
            
            'mediacat__Image_Width_req'=>'',
            'mediacat__Image_Width_title'=>'Image Width',
            'mediacat__Image_Width_max'=>'11',
            'mediacat__Image_Width_validateas'=>'int',
            'mediacat__Image_Width_html5_req'=>'',
            'mediacat__Image_Width_html5_type'=>'text',
            
            
            'mediacat__Image_Height_req'=>'',
            'mediacat__Image_Height_title'=>'Image Height',
            'mediacat__Image_Height_max'=>'11',
            'mediacat__Image_Height_validateas'=>'int',
            'mediacat__Image_Height_html5_req'=>'',
            'mediacat__Image_Height_html5_type'=>'text',
            
            
            'mediacat__Sequence_req'=>'*',
            'mediacat__Sequence_title'=>'Sequence',
            'mediacat__Sequence_max'=>'',
            'mediacat__Sequence_validateas'=>'required',
            'mediacat__Sequence_html5_req'=>'required',
            'mediacat__Sequence_html5_type'=>'text',
            
            
            'mediacat__Last_Action_On_req'=>'*',
            'mediacat__Last_Action_On_title'=>'Last Action On',
            'mediacat__Last_Action_On_max'=>'',
            'mediacat__Last_Action_On_validateas'=>'required',
            'mediacat__Last_Action_On_html5_req'=>'required',
            'mediacat__Last_Action_On_html5_type'=>'text',
            
            
            'mediacat__Last_Action_By_req'=>'*',
            'mediacat__Last_Action_By_title'=>'Last Action By',
            'mediacat__Last_Action_By_max'=>'64',
            'mediacat__Last_Action_By_validateas'=>'required',
            'mediacat__Last_Action_By_html5_req'=>'required',
            'mediacat__Last_Action_By_html5_type'=>'text',
            
            
            'mediacat__dbState_req'=>'*',
            'mediacat__dbState_title'=>'dbState',
            'mediacat__dbState_max'=>'',
            'mediacat__dbState_validateas'=>'enum',
            'mediacat__dbState_html5_req'=>'required',
            'mediacat__dbState_html5_type'=>'text',
            'mediacat__dbState_array'=>array(''=>'Select..','Live'=>'Live','Deleted'=>'Deleted',),
            
        );
    
    $dbs_sulata_media_files = 
        array(
        
            'mediafile__ID_req'=>'*',
            'mediafile__ID_title'=>'ID',
            'mediafile__ID_max'=>'11',
            'mediafile__ID_validateas'=>'int',
            'mediafile__ID_html5_req'=>'required',
            'mediafile__ID_html5_type'=>'text',
            
            
            'mediafile__Category_req'=>'*',
            'mediafile__Category_title'=>'Category',
            'mediafile__Category_max'=>'11',
            'mediafile__Category_validateas'=>'int',
            'mediafile__Category_html5_req'=>'required',
            'mediafile__Category_html5_type'=>'text',
            
            
            'mediafile__Title_req'=>'*',
            'mediafile__Title_title'=>'Title',
            'mediafile__Title_max'=>'128',
            'mediafile__Title_validateas'=>'required',
            'mediafile__Title_html5_req'=>'required',
            'mediafile__Title_html5_type'=>'text',
            
            
            'mediafile__File_req'=>'*',
            'mediafile__File_title'=>'File',
            'mediafile__File_max'=>'128',
            'mediafile__File_validateas'=>'file',
            'mediafile__File_html5_req'=>'required',
            'mediafile__File_html5_type'=>'file',
            
            
            'mediafile__Short_Description_req'=>'',
            'mediafile__Short_Description_title'=>'Short Description',
            'mediafile__Short_Description_max'=>'',
            'mediafile__Short_Description_validateas'=>'',
            'mediafile__Short_Description_html5_req'=>'',
            'mediafile__Short_Description_html5_type'=>'file',
            
            
            'mediafile__Long_Description_req'=>'',
            'mediafile__Long_Description_title'=>'Long Description',
            'mediafile__Long_Description_max'=>'',
            'mediafile__Long_Description_validateas'=>'',
            'mediafile__Long_Description_html5_req'=>'',
            'mediafile__Long_Description_html5_type'=>'file',
            
            
            'mediafile__Sequence_req'=>'*',
            'mediafile__Sequence_title'=>'Sequence',
            'mediafile__Sequence_max'=>'',
            'mediafile__Sequence_validateas'=>'required',
            'mediafile__Sequence_html5_req'=>'required',
            'mediafile__Sequence_html5_type'=>'text',
            
            
            'mediafile__Date_req'=>'*',
            'mediafile__Date_title'=>'Date',
            'mediafile__Date_max'=>'',
            'mediafile__Date_validateas'=>'required',
            'mediafile__Date_html5_req'=>'required',
            'mediafile__Date_html5_type'=>'text',
            
            
            'mediafile__Last_Action_On_req'=>'*',
            'mediafile__Last_Action_On_title'=>'Last Action On',
            'mediafile__Last_Action_On_max'=>'',
            'mediafile__Last_Action_On_validateas'=>'required',
            'mediafile__Last_Action_On_html5_req'=>'required',
            'mediafile__Last_Action_On_html5_type'=>'text',
            
            
            'mediafile__Last_Action_By_req'=>'*',
            'mediafile__Last_Action_By_title'=>'Last Action By',
            'mediafile__Last_Action_By_max'=>'64',
            'mediafile__Last_Action_By_validateas'=>'required',
            'mediafile__Last_Action_By_html5_req'=>'required',
            'mediafile__Last_Action_By_html5_type'=>'text',
            
            
            'mediafile__dbState_req'=>'*',
            'mediafile__dbState_title'=>'dbState',
            'mediafile__dbState_max'=>'',
            'mediafile__dbState_validateas'=>'enum',
            'mediafile__dbState_html5_req'=>'required',
            'mediafile__dbState_html5_type'=>'text',
            'mediafile__dbState_array'=>array(''=>'Select..','Live'=>'Live','Deleted'=>'Deleted',),
            
        );
    
    $dbs_sulata_pages = 
        array(
        
            'page__ID_req'=>'*',
            'page__ID_title'=>'ID',
            'page__ID_max'=>'11',
            'page__ID_validateas'=>'int',
            'page__ID_html5_req'=>'required',
            'page__ID_html5_type'=>'text',
            
            
            'page__Name_req'=>'*',
            'page__Name_title'=>'Name',
            'page__Name_max'=>'64',
            'page__Name_validateas'=>'required',
            'page__Name_html5_req'=>'required',
            'page__Name_html5_type'=>'text',
            
            
            'page__Heading_req'=>'*',
            'page__Heading_title'=>'Heading',
            'page__Heading_max'=>'128',
            'page__Heading_validateas'=>'required',
            'page__Heading_html5_req'=>'required',
            'page__Heading_html5_type'=>'text',
            
            
            'page__Permalink_req'=>'*',
            'page__Permalink_title'=>'Permalink',
            'page__Permalink_max'=>'64',
            'page__Permalink_validateas'=>'required',
            'page__Permalink_html5_req'=>'required',
            'page__Permalink_html5_type'=>'text',
            
            
            'page__Title_req'=>'*',
            'page__Title_title'=>'Title',
            'page__Title_max'=>'70',
            'page__Title_validateas'=>'required',
            'page__Title_html5_req'=>'required',
            'page__Title_html5_type'=>'text',
            
            
            'page__Keyword_req'=>'*',
            'page__Keyword_title'=>'Keyword',
            'page__Keyword_max'=>'255',
            'page__Keyword_validateas'=>'required',
            'page__Keyword_html5_req'=>'required',
            'page__Keyword_html5_type'=>'text',
            
            
            'page__Description_req'=>'*',
            'page__Description_title'=>'Description',
            'page__Description_max'=>'155',
            'page__Description_validateas'=>'required',
            'page__Description_html5_req'=>'required',
            'page__Description_html5_type'=>'text',
            
            
            'page__Header_req'=>'*',
            'page__Header_title'=>'Header',
            'page__Header_max'=>'11',
            'page__Header_validateas'=>'int',
            'page__Header_html5_req'=>'required',
            'page__Header_html5_type'=>'text',
            
            
            'page__Short_Text_req'=>'',
            'page__Short_Text_title'=>'Short Text',
            'page__Short_Text_max'=>'',
            'page__Short_Text_validateas'=>'',
            'page__Short_Text_html5_req'=>'',
            'page__Short_Text_html5_type'=>'text',
            
            
            'page__Long_Text_req'=>'*',
            'page__Long_Text_title'=>'Long Text',
            'page__Long_Text_max'=>'',
            'page__Long_Text_validateas'=>'required',
            'page__Long_Text_html5_req'=>'required',
            'page__Long_Text_html5_type'=>'text',
            
            
            'page__Link_Position_req'=>'*',
            'page__Link_Position_title'=>'Link Position',
            'page__Link_Position_max'=>'',
            'page__Link_Position_validateas'=>'enum',
            'page__Link_Position_html5_req'=>'required',
            'page__Link_Position_html5_type'=>'text',
            'page__Link_Position_array'=>array(''=>'Select..','Nowhere'=>'Nowhere','Top'=>'Top','Bottom'=>'Bottom','Side'=>'Side','Top+Bottom'=>'Top+Bottom','Top+Side'=>'Top+Side','Bottom+Side'=>'Bottom+Side','Top+Bottom+Side'=>'Top+Bottom+Side',),
            
            'page__Parent_req'=>'',
            'page__Parent_title'=>'Parent',
            'page__Parent_max'=>'11',
            'page__Parent_validateas'=>'int',
            'page__Parent_html5_req'=>'',
            'page__Parent_html5_type'=>'text',
            
            
            'page__Sequence_req'=>'*',
            'page__Sequence_title'=>'Sequence',
            'page__Sequence_max'=>'',
            'page__Sequence_validateas'=>'required',
            'page__Sequence_html5_req'=>'required',
            'page__Sequence_html5_type'=>'text',
            
            
            'page__Last_Action_On_req'=>'*',
            'page__Last_Action_On_title'=>'Last Action On',
            'page__Last_Action_On_max'=>'',
            'page__Last_Action_On_validateas'=>'required',
            'page__Last_Action_On_html5_req'=>'required',
            'page__Last_Action_On_html5_type'=>'text',
            
            
            'page__Last_Action_By_req'=>'*',
            'page__Last_Action_By_title'=>'Last Action By',
            'page__Last_Action_By_max'=>'64',
            'page__Last_Action_By_validateas'=>'required',
            'page__Last_Action_By_html5_req'=>'required',
            'page__Last_Action_By_html5_type'=>'text',
            
            
            'page__dbState_req'=>'*',
            'page__dbState_title'=>'dbState',
            'page__dbState_max'=>'',
            'page__dbState_validateas'=>'enum',
            'page__dbState_html5_req'=>'required',
            'page__dbState_html5_type'=>'text',
            'page__dbState_array'=>array(''=>'Select..','Live'=>'Live','Deleted'=>'Deleted',),
            
        );
    
    $dbs_sulata_settings = 
        array(
        
            'setting__ID_req'=>'*',
            'setting__ID_title'=>'ID',
            'setting__ID_max'=>'11',
            'setting__ID_validateas'=>'int',
            'setting__ID_html5_req'=>'required',
            'setting__ID_html5_type'=>'text',
            
            
            'setting__Setting_req'=>'*',
            'setting__Setting_title'=>'Setting',
            'setting__Setting_max'=>'64',
            'setting__Setting_validateas'=>'required',
            'setting__Setting_html5_req'=>'required',
            'setting__Setting_html5_type'=>'text',
            
            
            'setting__Key_req'=>'*',
            'setting__Key_title'=>'Key',
            'setting__Key_max'=>'64',
            'setting__Key_validateas'=>'required',
            'setting__Key_html5_req'=>'required',
            'setting__Key_html5_type'=>'text',
            
            
            'setting__Value_req'=>'*',
            'setting__Value_title'=>'Value',
            'setting__Value_max'=>'256',
            'setting__Value_validateas'=>'required',
            'setting__Value_html5_req'=>'required',
            'setting__Value_html5_type'=>'text',
            
            
            'setting__Type_req'=>'*',
            'setting__Type_title'=>'Type',
            'setting__Type_max'=>'',
            'setting__Type_validateas'=>'enum',
            'setting__Type_html5_req'=>'required',
            'setting__Type_html5_type'=>'text',
            'setting__Type_array'=>array(''=>'Select..','Private'=>'Private','Public'=>'Public','Site'=>'Site',),
            
            'setting__Last_Action_On_req'=>'*',
            'setting__Last_Action_On_title'=>'Last Action On',
            'setting__Last_Action_On_max'=>'',
            'setting__Last_Action_On_validateas'=>'required',
            'setting__Last_Action_On_html5_req'=>'required',
            'setting__Last_Action_On_html5_type'=>'text',
            
            
            'setting__Last_Action_By_req'=>'*',
            'setting__Last_Action_By_title'=>'Last Action By',
            'setting__Last_Action_By_max'=>'64',
            'setting__Last_Action_By_validateas'=>'required',
            'setting__Last_Action_By_html5_req'=>'required',
            'setting__Last_Action_By_html5_type'=>'text',
            
            
            'setting__dbState_req'=>'*',
            'setting__dbState_title'=>'dbState',
            'setting__dbState_max'=>'',
            'setting__dbState_validateas'=>'enum',
            'setting__dbState_html5_req'=>'required',
            'setting__dbState_html5_type'=>'text',
            'setting__dbState_array'=>array(''=>'Select..','Live'=>'Live','Deleted'=>'Deleted',),
            
        );
    
    $dbs_sulata_testimonials = 
        array(
        
            'testimonial__ID_req'=>'*',
            'testimonial__ID_title'=>'ID',
            'testimonial__ID_max'=>'11',
            'testimonial__ID_validateas'=>'int',
            'testimonial__ID_html5_req'=>'required',
            'testimonial__ID_html5_type'=>'text',
            
            
            'testimonial__Name_req'=>'*',
            'testimonial__Name_title'=>'Name',
            'testimonial__Name_max'=>'34',
            'testimonial__Name_validateas'=>'required',
            'testimonial__Name_html5_req'=>'required',
            'testimonial__Name_html5_type'=>'text',
            
            
            'testimonial__Location_req'=>'*',
            'testimonial__Location_title'=>'Location',
            'testimonial__Location_max'=>'100',
            'testimonial__Location_validateas'=>'required',
            'testimonial__Location_html5_req'=>'required',
            'testimonial__Location_html5_type'=>'text',
            
            
            'testimonial__Testimonial_req'=>'*',
            'testimonial__Testimonial_title'=>'Testimonial',
            'testimonial__Testimonial_max'=>'',
            'testimonial__Testimonial_validateas'=>'required',
            'testimonial__Testimonial_html5_req'=>'required',
            'testimonial__Testimonial_html5_type'=>'text',
            
            
            'testimonial__Date_req'=>'*',
            'testimonial__Date_title'=>'Date',
            'testimonial__Date_max'=>'',
            'testimonial__Date_validateas'=>'required',
            'testimonial__Date_html5_req'=>'required',
            'testimonial__Date_html5_type'=>'text',
            
            
            'testimonial__Status_req'=>'*',
            'testimonial__Status_title'=>'Status',
            'testimonial__Status_max'=>'',
            'testimonial__Status_validateas'=>'enum',
            'testimonial__Status_html5_req'=>'required',
            'testimonial__Status_html5_type'=>'text',
            'testimonial__Status_array'=>array(''=>'Select..','Active'=>'Active','Inactive'=>'Inactive',),
            
            'testimonial__Last_Action_On_req'=>'*',
            'testimonial__Last_Action_On_title'=>'Last Action On',
            'testimonial__Last_Action_On_max'=>'',
            'testimonial__Last_Action_On_validateas'=>'required',
            'testimonial__Last_Action_On_html5_req'=>'required',
            'testimonial__Last_Action_On_html5_type'=>'text',
            
            
            'testimonial__Last_Action_By_req'=>'*',
            'testimonial__Last_Action_By_title'=>'Last Action By',
            'testimonial__Last_Action_By_max'=>'64',
            'testimonial__Last_Action_By_validateas'=>'required',
            'testimonial__Last_Action_By_html5_req'=>'required',
            'testimonial__Last_Action_By_html5_type'=>'text',
            
            
            'testimonial__dbState_req'=>'*',
            'testimonial__dbState_title'=>'dbState',
            'testimonial__dbState_max'=>'',
            'testimonial__dbState_validateas'=>'enum',
            'testimonial__dbState_html5_req'=>'required',
            'testimonial__dbState_html5_type'=>'text',
            'testimonial__dbState_array'=>array(''=>'Select..','Live'=>'Live','Deleted'=>'Deleted',),
            
        );
    
    $dbs_sulata_users = 
        array(
        
            'user__ID_req'=>'*',
            'user__ID_title'=>'ID',
            'user__ID_max'=>'11',
            'user__ID_validateas'=>'int',
            'user__ID_html5_req'=>'required',
            'user__ID_html5_type'=>'text',
            
            
            'user__Name_req'=>'*',
            'user__Name_title'=>'Name',
            'user__Name_max'=>'32',
            'user__Name_validateas'=>'required',
            'user__Name_html5_req'=>'required',
            'user__Name_html5_type'=>'text',
            
            
            'user__Phone_req'=>'',
            'user__Phone_title'=>'Phone',
            'user__Phone_max'=>'32',
            'user__Phone_validateas'=>'',
            'user__Phone_html5_req'=>'',
            'user__Phone_html5_type'=>'text',
            
            
            'user__Email_req'=>'*',
            'user__Email_title'=>'Email',
            'user__Email_max'=>'64',
            'user__Email_validateas'=>'email',
            'user__Email_html5_req'=>'required',
            'user__Email_html5_type'=>'text',
            
            
            'user__Password_req'=>'*',
            'user__Password_title'=>'Password',
            'user__Password_max'=>'64',
            'user__Password_validateas'=>'password',
            'user__Password_html5_req'=>'required',
            'user__Password_html5_type'=>'password',
            
            
            'user__Status_req'=>'*',
            'user__Status_title'=>'Status',
            'user__Status_max'=>'',
            'user__Status_validateas'=>'enum',
            'user__Status_html5_req'=>'required',
            'user__Status_html5_type'=>'text',
            'user__Status_array'=>array(''=>'Select..','Active'=>'Active','Inactive'=>'Inactive',),
            
            'user__Picture_req'=>'',
            'user__Picture_title'=>'Picture',
            'user__Picture_max'=>'128',
            'user__Picture_validateas'=>'image',
            'user__Picture_html5_req'=>'',
            'user__Picture_html5_type'=>'file',
            
            
            'user__Type_req'=>'*',
            'user__Type_title'=>'Type',
            'user__Type_max'=>'',
            'user__Type_validateas'=>'enum',
            'user__Type_html5_req'=>'required',
            'user__Type_html5_type'=>'text',
            'user__Type_array'=>array(''=>'Select..','Admin'=>'Admin','Company User'=>'Company User','Client User'=>'Client User',),
            
            'user__Notes_req'=>'',
            'user__Notes_title'=>'Notes',
            'user__Notes_max'=>'',
            'user__Notes_validateas'=>'',
            'user__Notes_html5_req'=>'',
            'user__Notes_html5_type'=>'text',
            
            
            'user__Theme_req'=>'*',
            'user__Theme_title'=>'Theme',
            'user__Theme_max'=>'24',
            'user__Theme_validateas'=>'required',
            'user__Theme_html5_req'=>'required',
            'user__Theme_html5_type'=>'text',
            
            
            'user__Last_Action_On_req'=>'*',
            'user__Last_Action_On_title'=>'Last Action On',
            'user__Last_Action_On_max'=>'',
            'user__Last_Action_On_validateas'=>'required',
            'user__Last_Action_On_html5_req'=>'required',
            'user__Last_Action_On_html5_type'=>'text',
            
            
            'user__Last_Action_By_req'=>'*',
            'user__Last_Action_By_title'=>'Last Action By',
            'user__Last_Action_By_max'=>'64',
            'user__Last_Action_By_validateas'=>'required',
            'user__Last_Action_By_html5_req'=>'required',
            'user__Last_Action_By_html5_type'=>'text',
            
            
            'user__dbState_req'=>'*',
            'user__dbState_title'=>'dbState',
            'user__dbState_max'=>'',
            'user__dbState_validateas'=>'enum',
            'user__dbState_html5_req'=>'required',
            'user__dbState_html5_type'=>'text',
            'user__dbState_array'=>array(''=>'Select..','Live'=>'Live','Deleted'=>'Deleted',),
            
            'user__IP_req'=>'*',
            'user__IP_title'=>'IP',
            'user__IP_max'=>'15',
            'user__IP_validateas'=>'required',
            'user__IP_html5_req'=>'required',
            'user__IP_html5_type'=>'text',
            
            
        );
    
    $uniqueArray = array('faq__Question','header__Title','mediacat__Name','page__Name','setting__Setting','setting__Key','user__Email');