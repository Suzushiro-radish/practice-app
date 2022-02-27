import React from 'react';

export default ({ label, name, value, className, errors = [], ...props }) => {
  return (
    <div className={className}>
      {label && (
        <label className="form-label" htmlFor={name}>
          {label}:
        </label>
      )}
      <input
        id={name}
        name={name}
        value={value}
        {...props}
        className={`bg-gray-100 form-input ${errors.length ? 'error' : ''}`}
      />
      {errors && <div className="form-error">{errors}</div>}
    </div>
  );
};