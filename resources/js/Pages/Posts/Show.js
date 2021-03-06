import React from "react";
import Button from '@mui/material/Button';
import Authenticated from "@/Layouts/Authenticated";
import { Head } from "@inertiajs/inertia-react";
import { InertiaLink, usePage } from '@inertiajs/inertia-react';
import Post from './Post'


export default function Show(props) {
    const post = usePage().props.post;
    
    console.log(post);
    
    return (
        <Authenticated
            auth={props.auth}
            errors={props.errors}
            header={<h2 className="font-semibold text-xl text-gray-800 leading-tight">{post.title}</h2>}
        >
            <Head title={post.title} />
            
            <div className="py-12">
                <div className="max-w-7xl mx-auto sm:px-6 lg:px-8">
                    <div className="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                        <div className="p-6 bg-white border-b border-gray-200">
                            {post.body}
                        </div>
                    </div>
                </div>
            </div>
        </Authenticated>
    );
}