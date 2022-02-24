import React from 'react';
import { InertiaLink, usePage } from '@inertiajs/inertia-react';
import { Link } from '@inertiajs/inertia-react'


export default function Post(props){
    
    return(
        <div className="p-6 bg-white border-b border-gray-200">
            <div className="post">
                <Link href={ route('post.show', props.id) }>{props.title}</Link>
                <div className="body">
                    { props.body }
                </div>
                <div>{props.is_bookmarked 
                ? <Link href={ route('bookmark.destroy', props.id) } method='post' as="button" type="button">解除</Link>
                : <Link href={ route('bookmark.store', props.id) } method='post' as="button" type="button">登録</Link>
                }</div>
            </div>
        </div>
    );
}