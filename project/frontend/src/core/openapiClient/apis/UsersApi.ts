/* tslint:disable */
/* eslint-disable */
/**
 * OpenAPI Tutorial
 * OpenAPI Tutorial by halhorn
 *
 * The version of the OpenAPI document: 0.0.0
 * 
 *
 * NOTE: This class is auto generated by OpenAPI Generator (https://openapi-generator.tech).
 * https://openapi-generator.tech
 * Do not edit the class manually.
 */


import * as runtime from '../runtime';
import {
    InlineObject,
    InlineObjectFromJSON,
    InlineObjectToJSON,
    User,
    UserFromJSON,
    UserToJSON,
} from '../models';

export interface UsersPostRequest {
    inlineObject: InlineObject;
}

/**
 * UsersApi - interface
 * 
 * @export
 * @interface UsersApiInterface
 */
export interface UsersApiInterface {
    /**
     * 詳細内容
     * @summary 新規登録
     * @param {InlineObject} inlineObject 
     * @param {*} [options] Override http request option.
     * @throws {RequiredError}
     * @memberof UsersApiInterface
     */
    usersPostRaw(requestParameters: UsersPostRequest, initOverrides?: RequestInit): Promise<runtime.ApiResponse<User>>;

    /**
     * 詳細内容
     * 新規登録
     */
    usersPost(requestParameters: UsersPostRequest, initOverrides?: RequestInit): Promise<User>;

}

/**
 * 
 */
export class UsersApi extends runtime.BaseAPI implements UsersApiInterface {

    /**
     * 詳細内容
     * 新規登録
     */
    async usersPostRaw(requestParameters: UsersPostRequest, initOverrides?: RequestInit): Promise<runtime.ApiResponse<User>> {
        if (requestParameters.inlineObject === null || requestParameters.inlineObject === undefined) {
            throw new runtime.RequiredError('inlineObject','Required parameter requestParameters.inlineObject was null or undefined when calling usersPost.');
        }

        const queryParameters: any = {};

        const headerParameters: runtime.HTTPHeaders = {};

        headerParameters['Content-Type'] = 'application/json';

        const response = await this.request({
            path: `/users`,
            method: 'POST',
            headers: headerParameters,
            query: queryParameters,
            body: InlineObjectToJSON(requestParameters.inlineObject),
        }, initOverrides);

        return new runtime.JSONApiResponse(response, (jsonValue) => UserFromJSON(jsonValue));
    }

    /**
     * 詳細内容
     * 新規登録
     */
    async usersPost(requestParameters: UsersPostRequest, initOverrides?: RequestInit): Promise<User> {
        const response = await this.usersPostRaw(requestParameters, initOverrides);
        return await response.value();
    }

}
