import React from "react";
import Button from '@mui/material/Button';
import { Head } from "@inertiajs/inertia-react";
import { InertiaLink, usePage } from '@inertiajs/inertia-react';
import Post from './Post'
import Layout from "@/Layouts/Layout";


// export default function Index(props) {
//     const posts = props.posts;
    
//     return (
//         <Layout
//         <MainMenu />
//             <Head title="投稿一覧" />

//             <div className="py-12">
//                 <div className="max-w-7xl mx-auto sm:px-6 lg:px-8">
//                     <div className="bg-white shadow-sm sm:rounded-lg">
//                         { posts.map( (post) => {
//                             return (
//                                 <Post
//                                     key = {post.id}
//                                     id = {post.id}
//                                     title = {post.title}
//                                     body = {post.body}
//                                     is_bookmarked = {post.is_bookmarked}
//                                 />
//                             );
//                         })}
//                     </div>
//                 </div>
//             </div>
//         </>
//     );
// }


const Index = (props) => {
  return (
    <Layout title="投稿一覧" >
      <h1 className="mb-8 text-3xl font-bold">Index</h1>
      <div className="items-center justify-between mb-6">
        <InertiaLink
          className="btn-indigo"
          href={route('posts.create')}
        >
          <span className="bg-black text-white">投稿</span>
        </InertiaLink>
      </div>
      <div className="overflow-x-auto bg-white rounded shadow">
        { props.posts.map( (post) => {
            return (
                <Post
                    key = {post.id}
                    id = {post.id}
                    title = {post.title}
                    body = {post.body}
                    is_bookmarked = {post.is_bookmarked}
                />
            );
        })}
      </div>
    </Layout>
  );
};

export default Index;
