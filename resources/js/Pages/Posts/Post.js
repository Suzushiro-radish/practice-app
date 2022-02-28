import React from 'react';
import { InertiaLink, usePage } from '@inertiajs/inertia-react';
import { Link } from '@inertiajs/inertia-react'


export default function Post(props){
    
    return(
        <div className="p-6 m-3 bg-white border rounded-md border-gray-200">
            <div className="post">
                <Link href={ route('post.show', props.id) }>{props.title}</Link>
                <div className="body">
                    { props.body }
                </div>
                <div>{props.is_bookmarked 
                ? <Link preserveScroll　href={ route('bookmark.destroy', props.id) } method='post' as="button" type="button" ><img src={"/img/unbookmarked.svg"} className="w-10" /></Link>
                : <Link preserveScroll　href={ route('bookmark.store', props.id) } method='post' as="button" type="button" ><img src={"/img/bookmarked.svg"}　className="w-10" /></Link>
                }</div>
            </div>
        </div>
    );
}