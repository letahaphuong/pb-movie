import {  Controller } from "react-hook-form";

const InputField = (props) => (
    <div>
        <Controller
            name={props?.name}
            control={props?.control}
            render={({ field }) => (
                <input {...field} type={props?.Controllertype} placeholder={props?.placeholder} />
            )}
        />
        <p>{props?.error?.message}</p>
    </div>
);
export default InputField 