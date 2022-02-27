import React from 'react';
import { Inertia } from '@inertiajs/inertia';
import { InertiaLink, usePage, useForm } from '@inertiajs/inertia-react';
import Layout from '@/Layouts/Layout';
import TextInput from '@/Layouts/TextInput';
import LoadingButton from '@/Layouts/LoadingButton'

const Create = (props) => {
  const { data, setData, errors, post, processing } = useForm({
    title: "",
    body: "",
    instrument_id: "",
    file: "",
  });

  function handleSubmit(e) {
    e.preventDefault();
    post(route('posts.store'));
  }

  return (
    <div>
      <div className="max-w-3xl overflow-hidden bg-white rounded shadow">
        <form onSubmit={handleSubmit} encType="multipart/form-data">
          <div className="flex flex-wrap p-8 -mb-8 -mr-6">
            <select 
              name="instrument_id"
              onChange={e => setData('instrument_id', e.target.value)}
            >
              { props.instruments.map( (instrument) => {
                return(
                  <option value={instrument.id} key={instrument.id}>{instrument.name}</option>
                );
              })}
            </select>
            
            <TextInput
              className="w-full pb-8 pr-6 lg:w-1/2"
              label="タイトル"
              name="title"
              value={data.title}
              errors={errors.title}
              onChange={e => setData('title', e.target.value)}
            />
            
            <TextInput
              className="w-full pb-8 pr-6 lg:w-1/2"
              label="本文"
              name="body"
              value={data.body}
              errors={errors.body}
              onChange={e => setData('body', e.target.value)}
            />
            
            <input 
              type="file"
              name="file"
              onChange={e => setData('file', e.target.files[0])}
            />
            
            
          </div>
          <div className="flex items-center justify-end px-8 py-4 bg-gray-100 border-t border-gray-200">
            <LoadingButton
              type="submit"
              className="btn-indigo"
            >
              Submit
            </LoadingButton>
          </div>
        </form>
      </div>
    </div>
  );
};

Create.layout = page => <Layout title="Create" children={page} />;

export default Create;