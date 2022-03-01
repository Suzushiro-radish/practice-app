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
      <div className="bg-white rounded shadow">
        <form onSubmit={handleSubmit} encType="multipart/form-data">
          <div className="flex">
            <div>
              <select 
                name="instrument_id"
                onChange={e => setData('instrument_id', e.target.value)}
              >
                <option value="">楽器を選択してください</option>
                { props.instruments.map( (instrument) => {
                  return(
                    <option value={instrument.id} key={instrument.id}>{instrument.name}</option>
                  );
                })}
              </select>
            </div>
            
            <div>
              <TextInput
                className="w-full"
                label="タイトル"
                name="title"
                value={data.title}
                errors={errors.title}
                onChange={e => setData('title', e.target.value)}
              />
            </div>
            
            <div>
              <TextInput
                className="w-full"
                label="本文"
                name="body"
                value={data.body}
                errors={errors.body}
                onChange={e => setData('body', e.target.value)}
              />
            </div>
            
            <div>
              <input 
                type="file"
                name="file"
                onChange={e => setData('file', e.target.files[0])}
              />
            </div>
            
          </div>
          <div>
            <LoadingButton
              type="submit"
              className="btn"
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