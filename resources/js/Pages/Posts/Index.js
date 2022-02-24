import React from "react";
import Button from '@mui/material/Button';
import Authenticated from "@/Layouts/Authenticated";
import { Head } from "@inertiajs/inertia-react";
import { InertiaLink, usePage } from '@inertiajs/inertia-react';
import Post from './Post'


export default function Index(props) {
    const posts = props.posts;
    
    return (
        <Authenticated
            auth={props.auth}
            errors={props.errors}
            header={<h2 className="font-semibold text-xl text-gray-800 leading-tight">Index</h2>}
        >
            <Head title="投稿一覧" />

            <div className="py-12">
                <div className="max-w-7xl mx-auto sm:px-6 lg:px-8">
                    <div className="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                        { posts.map( (post) => {
                            return (
                                <Post
                                    id = {post.id}
                                    title = {post.title}
                                    body = {post.body}
                                    is_bookmarked = {post.is_bookmarked}
                                />
                            );
                        })}
                    </div>
                </div>
            </div>
        </Authenticated>
    );
}