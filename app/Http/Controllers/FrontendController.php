<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;
use Illuminate\Http\RedirectResponse;
use Brian2694\Toastr\Facades\Toastr;

use App\Mail\PasswordReset;
use Carbon\Carbon;

use App\Models\User;
use App\Models\cryptos;
use App\Models\settings;
use App\Models\balances;
use App\Models\deposits;
use App\Models\getaways;
use App\Models\transections;
use App\Models\withdrawals;
use App\Models\withdraw_methods;
use App\Models\blogs;
use App\Models\categories;
use App\Models\pages;
use App\Models\hdnevmain;
use App\Models\hdnevsub;
use App\Models\ftrnevmain;
use App\Models\ftrnevsub;
use App\Models\comments;
use App\Models\siteads;

class FrontendController extends Controller
{
    public function FrontIndex()
    {
        $data['tittle'] = 'Home';
        $data['set'] = settings::findOrFail(1);
        $data['cryptos'] = cryptos::wherestatus(1)->limit(12)->get();
        $data['blogs'] = blogs::wherestatus(1)->limit(3)->orderBy('id', 'DESC')->get();
        $data['admin'] = User::wheretype(2)->first();
        $data['headermain'] = hdnevmain::wherestatus(1)->orderBy('place_id')->get();
        $data['headersub'] = hdnevsub::wherestatus(1)->get();
        $data['footermain'] = ftrnevmain::wherestatus(1)->orderBy('place_id')->get();
        $data['footersub'] = ftrnevsub::wherestatus(1)->get();
        return view('front.home', $data);
    }


    public function ContactPage()
    {
        $data['tittle'] = 'Contact';
        $data['set'] = settings::findOrFail(1);
        return view('front.contact', $data);
    }


    public function UiSocialLinks(request $request)
    {
        $set = settings::findOrFail(1);
        $set->facebook_link = $request->facebook_link;
        $set->twitter_link = $request->twitter_link;
        $set->linkedin_link = $request->linkedin_link;
        $set->youtube_link = $request->youtube_link;
        $set->save();

        Toastr::success('Social Links Successfully Saved.', 'Success');
        return back();
    }


    public function UiNavigation()
    {
        $user = User::findOrFail(Auth::user()->id);
        
        if($user->type==2 || $user->type==3){
            $data['tittle'] = 'Frontend Navigation';
            $data['set'] = settings::findOrFail(1);
            $data['headermain'] = hdnevmain::wherestatus(1)->get();
            $data['headersub'] = hdnevsub::wherestatus(1)->get();
            $data['footermain'] = ftrnevmain::wherestatus(1)->get();
            $data['footersub'] = ftrnevsub::wherestatus(1)->get();
            $data['footermain'] = ftrnevmain::wherestatus(1)->orderBy('place_id')->get();
            $data['footersub'] = ftrnevsub::wherestatus(1)->get();
            return view('admin.front-update.navigation', $data);
        }
        else{
        Toastr::warning('Sorry your are not allowed to this area.', 'Warning', ['options']);
        return redirect('/dashboard');  
        }   
    }

    public function MainNevAdd(request $request)
    {
        $mainnev = new hdnevmain();
        $mainnev->place_id = $request->place_id;
        $mainnev->ref_id = Str::random(10);
        $mainnev->name = $request->name;
        $mainnev->link = $request->link;
        $mainnev->status = 1;
        $mainnev->save();

        Toastr::success('Main Menu Added To Frontend.', 'Success');
        return back();
    }


    public function MainNevEdit(request $request)
    {
        $mainnev = hdnevmain::whereref_id($request->mainnevid)->first();
        $mainnev->place_id = $request->place_id;        
        $mainnev->name = $request->name;
        $mainnev->link = $request->link;        
        $mainnev->save();

        Toastr::success('Main Menu Edited Data Saved To Frontend.', 'Success');
        return back();
    }


    public function MainNevDelete($id)
    {
        $mainnev = hdnevmain::findOrFail($id);        
        $mainnev->delete();

        Toastr::success('Main Menu Delete Successfully From Frontend.', 'Success');
        return back();
    }


    public function CryptoExchangeWidget($refid)
    {
        $data['tittle'] = 'Crypto Exchange Widget';
        $data['set'] = settings::findOrFail(1);
        $data['referralid'] = $refid;
        return view('front.crypto-exchange-widget', $data);
    }


    public function SubNevAdd(request $request)
    {
        $mainnev = hdnevmain::findOrFail($request->main_menu_id);

        $subnev = new hdnevsub();
        $subnev->ref_id = Str::random(10);
        $subnev->main_menu_id = $request->main_menu_id;
        $subnev->name = $request->name;
        $subnev->link = $request->link;
        $subnev->status = 1;
        $subnev->save();

        Toastr::success('Sub Menu Added To Frontend Under '.$mainnev->name.'', 'Success');
        return back();
    }


    public function SubNevEdit(request $request)
    {
        $mainnev = hdnevsub::whereref_id($request->subnevid)->first();                
        $mainnev->name = $request->name;
        $mainnev->link = $request->link;        
        $mainnev->save();

        Toastr::success('Sub Menu Edited Data Saved To Frontend.', 'Success');
        return back();
    }


    public function SubNevDelete($id)
    {
        $mainnev = hdnevsub::findOrFail($id);        
        $mainnev->delete();

        Toastr::success('Sub Menu Delete Successfully From Frontend.', 'Success');
        return back();
    }


    public function FooterMainNevAdd(request $request)
    {
        $mainnev = new ftrnevmain();
        $mainnev->place_id = $request->place_id;
        $mainnev->ref_id = Str::random(10);
        $mainnev->name = $request->name;
        $mainnev->link = $request->link;
        $mainnev->status = 1;
        $mainnev->save();

        Toastr::success('Footer Main Menu Added To Frontend.', 'Success');
        return back();
    }



    public function FooterMainNevEdit(request $request)
    {
        $mainnev = ftrnevmain::whereref_id($request->mainnevid)->first();
        $mainnev->place_id = $request->place_id;        
        $mainnev->name = $request->name;
        $mainnev->link = $request->link;        
        $mainnev->save();

        Toastr::success('Footer Main Menu Edited Data Saved To Frontend.', 'Success');
        return back();
    }


    public function FooterMainNevDelete($id)
    {
        $mainnev = ftrnevmain::findOrFail($id);        
        $mainnev->delete();

        Toastr::success('Footer Main Menu Delete Successfully From Frontend.', 'Success');
        return back();
    }


    public function FooterSubNevAdd(request $request)
    {
        $mainnev = ftrnevmain::findOrFail($request->main_menu_id);

        $subnev = new ftrnevsub();
        $subnev->ref_id = Str::random(10);
        $subnev->main_menu_id = $request->main_menu_id;
        $subnev->name = $request->name;
        $subnev->link = $request->link;
        $subnev->status = 1;
        $subnev->save();

        Toastr::success('Sub Menu Added To Frontend Footer Under '.$mainnev->name.'', 'Success');
        return back();   
    }


    public function FooterSubNevEdit(request $request)
    {
        $mainnev = ftrnevsub::whereref_id($request->subnevid)->first();                
        $mainnev->name = $request->name;
        $mainnev->link = $request->link;        
        $mainnev->save();

        Toastr::success('Sub Menu Edited Data Saved To Frontend.', 'Success');
        return back();
    }


    public function FooterSubNevDelete($id)
    {
        $mainnev = ftrnevsub::findOrFail($id);        
        $mainnev->delete();

        Toastr::success('Sub Menu Delete Successfully From Frontend.', 'Success');
        return back();
    }
    

    public function FrontBlogPage($link)
    {
        $blog = blogs::whereblog_link($link)->First();
        $data['tittle'] = 'Blog | '.$blog->blog_tittle;
        $data['set'] = settings::findOrFail(1);
        $data['blogs'] = blogs::whereblog_link($link)->First();
        $data['bloglist'] = blogs::wherestatus(1)->limit(5)->orderBy('id', 'DESC')->get();
        $data['admin'] = User::wheretype(2)->first();
        $data['headermain'] = hdnevmain::wherestatus(1)->orderBy('place_id')->get();
        $data['headersub'] = hdnevsub::wherestatus(1)->get();
        $data['footermain'] = ftrnevmain::wherestatus(1)->orderBy('place_id')->get();
        $data['footersub'] = ftrnevsub::wherestatus(1)->get();
        $data['comments'] = comments::whereblog_id($link)->get();
        $data['totalcomments'] = comments::whereblog_id($link)->count();
        $data['ads'] = siteads::wherestatus(1)->inRandomOrder()->limit(2)->get();
        return view('front.sblog', $data);
    }


    public function BlogCommentAdd(request $request)
    {
        $comment = new comments();
        $comment->blog_id = $request->blog_link;
        $comment->name = $request->name;
        $comment->email = $request->email;
        $comment->phone = $request->phone;
        $comment->comment = $request->message;
        $comment->status = 1;
        $comment->date = Carbon::now();
        $comment->save();

        return redirect ('/blogs/'.$request->blog_link.'?success=Successfully Added#comment-sec');
    }


    public function FrontSinglePage($link)
    {
        if(pages::wherepage_link($link)->First())
        {
        $page = pages::wherepage_link($link)->First();
        $data['tittle'] = 'Page | '.$page->page_tittle;
        $data['set'] = settings::findOrFail(1);
        $data['page'] = pages::wherepage_link($link)->First();
        $data['admin'] = User::wheretype(2)->first();
        $data['headermain'] = hdnevmain::wherestatus(1)->orderBy('place_id')->get();
        $data['headersub'] = hdnevsub::wherestatus(1)->get();
        $data['footermain'] = ftrnevmain::wherestatus(1)->orderBy('place_id')->get();
        $data['footersub'] = ftrnevsub::wherestatus(1)->get();
        return view('front.spage', $data);
        }
        else
        {
        Toastr::warning('Your Page Link Not Valid, Please check and try again.', 'Not Found', ['options']);
        return redirect('/');
        }
    }

    public function UserLoginReset()
    {
        $data['tittle'] = 'User Login Reset';
        $data['set'] = settings::findOrFail(1);
        $data['headermain'] = hdnevmain::wherestatus(1)->orderBy('place_id')->get();
        $data['headersub'] = hdnevsub::wherestatus(1)->get();
        $data['footermain'] = ftrnevmain::wherestatus(1)->orderBy('place_id')->get();
        $data['footersub'] = ftrnevsub::wherestatus(1)->get();
        return view('auth.reset', $data);
    }

    public function PasswordResetSend(request $request)
    {
        if(User::where('email', $request->email)->first()){
            $str = Str::random(7);
            $user = User::where('email', $request->email)->first();
            $user->password = Hash::make($str);
            $user->save();

            $details = [
                'name' => "$user->name",
                'password' => "$str"
            ];

            Mail::to("$user->email")->send(new PasswordReset($details));
            Toastr::success('Your password send to your account email. please check your email.', 'Send!', ['options']);
            return back();
        }
        else{
            Toastr::warning('Account not found with your email id.', 'Not Found', ['options']);
            return back();
        }
    }

    public function UiHomeUpdate()
    {
        $user = User::findOrFail(Auth::user()->id);
        if($user->type==2 || $user->type==3){
        $data['tittle'] = 'Frontend UI Update';
        $data['set'] = settings::findOrFail(1);
        return view('admin.front-update.homepage', $data);
        }
        else{
            Toastr::warning('Sorry your are not allowed to this area.', 'Warning', ['options']);
            return redirect('/dashboard');  
            }
    }

    public function UiSection1Text(request $request)
    {
        $set = settings::findOrFail(1);
        $set->set1_h = $request->set1_h;
        $set->set1_p = $request->set1_p;
        $set->set1_b1_text = $request->set1_b1_text;
        $set->set1_b1_link = $request->set1_b1_link;
        $set->set1_b2_text = $request->set1_b2_text;
        $set->set1_b2_link = $request->set1_b2_link;
        $set->save();

        if($set){
        Toastr::success('Section 1 Texts Successfully Saved!', 'Success');
        return back();
        }
        else{
        Toastr::success('Server not response.', 'Opps!');
        return back();
        }
    }

    public function UiSection1Widget(request $request)
    {
        $set = settings::findOrFail(1);
        $set->set1_widget = $request->set1_widget;
        $set->save();

        if($set){
        Toastr::success('Section 1 Widget Code Successfully Saved!', 'Success');
        return back();
        }
        else{
        Toastr::success('Server not response.', 'Opps!');
        return back();
        }
    }


    public function UiSection2All(request $request)
    {
        $set = settings::findOrFail(1);
        $set->set2_h = $request->set2_h;

        $set->set2_cat1_icon = $request->set2_cat1_icon;
        $set->set2_cat1_text = $request->set2_cat1_text;

        $set->set2_cat2_icon = $request->set2_cat2_icon;
        $set->set2_cat2_text = $request->set2_cat2_text;

        $set->set2_cat3_icon = $request->set2_cat3_icon;
        $set->set2_cat3_text = $request->set2_cat3_text;

        $set->save();

        if($set){
        Toastr::success('Section 2 Texts & Icon Code Successfully Saved!', 'Success');
        return back();
        }
        else{
        Toastr::success('Server not response.', 'Opps!');
        return back();
        }
    }

    public function UiSection3TextIcons (request $request)
    {
        $set = settings::findOrFail(1);
        
        $set->set3_cat1_icon = $request->set3_cat1_icon;
        $set->set3_cat1_h = $request->set3_cat1_h;
        $set->set3_cat1_p = $request->set3_cat1_p;

        $set->set3_cat2_icon = $request->set3_cat2_icon;
        $set->set3_cat2_h = $request->set3_cat2_h;
        $set->set3_cat2_p = $request->set3_cat2_p;

        $set->set3_cat3_icon = $request->set3_cat3_icon;
        $set->set3_cat3_h = $request->set3_cat3_h;
        $set->set3_cat3_p = $request->set3_cat3_p;

        $set->set3_cat4_icon = $request->set3_cat4_icon;
        $set->set3_cat4_h = $request->set3_cat4_h;
        $set->set3_cat4_p = $request->set3_cat4_p;

        $set->save();

        if($set){
        Toastr::success('Section 3 Texts & Icon Code Successfully Saved!', 'Success');
        return back();
        }
        else{
        Toastr::success('Server not response.', 'Opps!');
        return back();
        }

    }

    public function UiSection3Image (request $request)
    {
        $str = Str::random(10);
        $file = $request->image;
        $filename = $str.'.'.$file->getClientOriginalExtension();
        $request->image->move('img/frontend', $filename);

        $set = settings::findOrFail(1);
        $set->set3_image = $filename;
        $set->save();

        if($set){
        Toastr::success('Section 3 Image Successfully Saved!', 'Success');
        return back();
        }
        else{
        Toastr::success('Server not response.', 'Opps!');
        return back();
        }
    }

    
    public function UiSection4TextIcons (request $request)
    {
        $set = settings::findOrFail(1);

        $set->set4_h = $request->set4_h;
        $set->set4_p = $request->set4_p;
        
        $set->set4_cat1_icon = $request->set4_cat1_icon;
        $set->set4_cat1_h = $request->set4_cat1_h;
        $set->set4_cat1_p = $request->set4_cat1_p;

        $set->set4_cat2_icon = $request->set4_cat2_icon;
        $set->set4_cat2_h = $request->set4_cat2_h;
        $set->set4_cat2_p = $request->set4_cat2_p;

        $set->set4_cat3_icon = $request->set4_cat3_icon;
        $set->set4_cat3_h = $request->set4_cat3_h;
        $set->set4_cat3_p = $request->set4_cat3_p;

        $set->save();

        if($set){
        Toastr::success('Section 4 Texts & Icon Code Successfully Saved!', 'Success');
        return back();
        }
        else{
        Toastr::success('Server not response.', 'Opps!');
        return back();
        }
    }


    public function BlogsList ()
    {
        $user = User::findOrFail(Auth::user()->id);
        if($user->type==2 || $user->type==3){
        $data['tittle'] = 'Blogs List';
        $data['set'] = settings::findOrFail(1);
        $data['blog'] = blogs::get();
        $data['catagories'] = categories::wherestatus(1)->get();
        return view('admin.front-update.blogs', $data);
        }
        else{
            Toastr::warning('Sorry your are not allowed to this area.', 'Warning', ['options']);
            return redirect('/dashboard');  
            }
    }


    public function PagesLists ()
    {
        $user = User::findOrFail(Auth::user()->id);
        if($user->type==2 || $user->type==3){
        $data['tittle'] = 'Page List';
        $data['set'] = settings::findOrFail(1);
        $data['pages'] = pages::get();
        $data['catagories'] = categories::wherestatus(1)->get();
        return view('admin.front-update.pages', $data);
        }
        else{
            Toastr::warning('Sorry your are not allowed to this area.', 'Warning', ['options']);
            return redirect('/dashboard');  
            }
    }


    public function PageNew ()
    {
        $user = User::findOrFail(Auth::user()->id);
        if($user->type==2){
        $data['tittle'] = 'Add New Page/Blog';
        $data['set'] = settings::findOrFail(1);
        $data['catagories'] = categories::wherestatus(1)->get();
        return view('admin.front-update.newpage', $data);
        }
        else{
            Toastr::warning('Sorry your are not allowed to this area.', 'Warning', ['options']);
            return redirect('/dashboard');  
            }
    }

    public function PageEditPage (request $request, $link, $type)
    {
        $user = User::findOrFail(Auth::user()->id);
        if($user->type==2){

            if($type == 'blog')
            {
            $data['tittle'] = 'Edit Blog';
            $data['blog'] = blogs::whereblog_link("$link")->first();
            $blog = blogs::whereblog_link("$link")->first();
            $data['categories'] = categories::findorFail($blog->categories_id);
            $data['set'] = settings::findOrFail(1);
            return view('admin.front-update.newpage', $data);
            }
            else{
            $data['tittle'] = 'Edit Page';
            $data['page'] = pages::wherepage_link("$link")->first();
            $page = pages::wherepage_link("$link")->first();
            $data['categories'] = categories::findorFail($page->categories_id);
            $data['set'] = settings::findOrFail(1);
            return view('admin.front-update.newpage', $data);
            }

        }
        else
        {
        Toastr::warning('Sorry your are not allowed to this area.', 'Warning', ['options']);
        return redirect('/dashboard');  
        }

    }

    public function PageAdd (request $request)
    {
        if($request->pageaction == 'New')
        {       
            if($request->pagetype == 'Page')
            {
                
                $page = new pages();
                $page->page_link = $request->pagelink;
                $page->page_tittle = $request->page_h;
                $page->page_short = $request->page_short;
                $page->page_body = $request->page_p;
                
                if(empty($request->image))
                {
                    $page->image = '1.jpg';
                }
                else{
                $imgstrpage = Str::random(10);
                $file = $request->image;
                $filename = $imgstrpage.'.'.$file->getClientOriginalExtension();
                $request->image->move('images/page/', $filename);
                $page->image = $filename;
                }

                $page->categories_id = $request->catagories;
                $page->status = $request->blog_status;

                $page->save();   
            }
            else{

                $str = Str::random(10);

                $blog = new blogs();
                $blog->user_id = Auth::user()->id;
                $blog->blog_link = $str;
                $blog->blog_tittle = $request->page_h;
                $blog->blog_short = $request->page_short;
                $blog->blog_body = $request->page_p;
                
                if(empty($request->image))
                {
                    $blog->image = '$blog->image';
                }
                else{
                $imgstr = Str::random(10);
                $file = $request->image;
                $filename = $imgstr.'.'.$file->getClientOriginalExtension();
                $request->image->move('images/blog/', $filename);
                $blog->image = $filename;
                }

                $blog->published_by = 'Admin';
                $blog->categories_id = $request->catagories;
                $blog->status = $request->blog_status;
                $blog->comments = 0;

                $blog->save();

            }

            if($request->pagetype == 'Page'){
            Toastr::success('Your Page successfully added to your frontend', 'Success',);
            return redirect ('/admin/page/e/'.$request->pagelink.'/page?type=Page&action=Edit');
            }
            else{
                Toastr::success('Your blog successfully added to your frontend', 'Success',);
                return redirect ('/admin/page/e/'.$str.'/blog?type=Blog&action=Edit');
            }
        }
        elseif($request->pageaction == 'Edit')
        {

            if($request->pagetype == 'Page')
            {
                $page = pages::wherepage_link($request->bloglink)->first();

                $page->page_link = $request->pagelink;
                $page->page_tittle = $request->page_h;
                $page->page_short = $request->page_short;
                $page->page_body = $request->page_p;

                if(empty($request->image))
                {
                    $page->image = $page->image;
                }
                else{            
                    $imgstr = Str::random(10);
                    $file = $request->image;
                    $filename = $imgstr.'.'.$file->getClientOriginalExtension();
                    $request->image->move('images/page/', $filename);
                    $page->image = $filename;
                }

                $page->categories_id = $request->catagories;
                $page->status = $request->blog_status;

                $page->save();

                Toastr::success('Page Updated Successfully', 'Success',);
                return redirect('/admin/page/e/'.$request->pagelink.'/page?type=Page&action=Edit');
            }
            else{
            $blog = blogs::whereblog_link($request->bloglink)->first();

            $blog->blog_link = $request->bloglink;
            $blog->blog_tittle = $request->page_h;
            $blog->blog_short = $request->page_short;
            $blog->blog_body = $request->page_p;

            if(empty($request->image))
            {                
                $blog->image = $blog->image;
            }
            else{            
                $imgstr = Str::random(10);
                $file = $request->image;
                $filename = $imgstr.'.'.$file->getClientOriginalExtension();
                $request->image->move('images/blog/', $filename);
                $blog->image = $filename;
            }

            $blog->published_by = 'Admin';
            $blog->categories_id = $request->catagories;
            $blog->status = $request->blog_status;
            $blog->comments = $blog->comments;

            $blog->save();

            Toastr::success('Blog Updated Successfully', 'Success',);
            return back();
            }
        }

    }

    public function BlogDelete($id)
    {
        $blog = blogs::findOrFail($id);
        $blog->delete();
        Toastr::success('Blog Deleted Successfully', 'Success',);
        return back();
    }


    public function PageDelete($id)
    {
        $page = pages::findOrFail($id);
        $page->delete();
        Toastr::success('Page Deleted Successfully', 'Success',);
        return back();
    }


    public function CatagoriesAdd (request $request)
    {
        $cata = new categories();
        $cata->name = $request->cat_name;
        $cata->status = 1;
        $cata->save();

        Toastr::success('Catagories Added Successfully', 'Success',);
        return back();
    }

    public function CatagoriesDelete($id)
    {
        $cata = categories::findOrFail($id);
        $cata->delete();
        Toastr::success('Catagories Deleted Successfully', 'Success',);
        return back();
    }


}
