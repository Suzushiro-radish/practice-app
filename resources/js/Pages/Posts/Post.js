import React from 'react';

export default function Post(props){
    
    return(
        <div className="p-6 bg-white border-b border-gray-200">
            <div className="post">
                <h2>{ props.title }</h2>
                <div className="body">
                    { props.body }
                </div>
            </div>
        </div>
    );
}