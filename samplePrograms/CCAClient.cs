using System;
using System.Collections.Specialized;
using System.Net;
using System.Text;

class CCAClient
{
    static void Main(string[] args)
    {
        using (var wb = new WebClient())
        {
            var data = new NameValueCollection();
            data["cc"] = "6011 1234 4321 1234";
            data["name"] = "John Doe";
            data["exp"] = "12/2018";
            data["amount"] = "543.21";

            var response = wb.UploadValues("http://blitz.cs.niu.edu/CreditCard/", "POST", data);

            Console.WriteLine(Encoding.UTF8.GetString(response));
            Console.ReadKey();
        }
    }
}