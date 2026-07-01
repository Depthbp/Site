#include <iostream>
using namespace std;
int arr[100];
int main()
{
    int n;
    cin >> n;
    for (int i = 0; < n; i++)
    {
        cin>>arr[i];
    }
    int v = 0;
    cin >> v;
    int cnt = 0;
    for (int i = 0; i < n; i++)
    {
        if(v=arr[i])
            cnt++;
    }
    count << cnt;
}